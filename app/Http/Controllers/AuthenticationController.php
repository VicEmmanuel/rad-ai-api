<?php

namespace App\Http\Controllers;


use App\Models\User;

use App\Traits\HttpResponses;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthenticationController extends Controller
{
    use HttpResponses;

    public function login(Request $request)
    {
        // Validate the input
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        // Return the first validation error if validation fails
        if ($validator->fails()) {
            return $this->error([], $validator->errors()->first(), 422);
        }

        // Check if the user exists before attempting to authenticate
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return $this->error([], 'User does not exist', 404);
        }

        // Attempt to authenticate the user with JWT
        $credentials = $request->only('email', 'password');
        if (!$token = JWTAuth::attempt($credentials)) {
            return $this->error([], 'Invalid login details', 401);
        }

        // Return the user data and the access token
        return $this->success([
            'user' => $user,
            'access_token' => $token
        ], 'Login Successful');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:12',
//            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8', // Ensure password validation
            'referral_code' => 'nullable|string|exists:users,referral_code', // Referral code validation
        ]);

        // Return the first validation error if validation fails
        if ($validator->fails()) {
            $error = $validator->errors()->first(); // Get the first error message
            return $this->error([], $error, 403);
        }

        // Generate a unique referral code

        // Create a new user
        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);
        // Send OTP for email verification
        $this->sendOtp($user);

        // Generate a JWT token for the newly created user
        $token = JWTAuth::fromUser($user);

        return $this->success([], 'Account created successfully');
    }



    public function sendOtp(User $user)
    {
        try {
            // Generate OTP
            $otp = rand(100000, 999999); // 6-digit OTP

            // Set OTP and expiration time (10 minutes from now)
            $user->otp = $otp;
            $user->otp_expires_at = Carbon::now()->addMinutes(10);
            $user->save();

            // Send OTP via Brevo API
            $client = new \GuzzleHttp\Client();
            $response = $client->post('https://api.brevo.com/v3/smtp/email', [
                'headers' => [
                    'accept' => 'application/json',
                    'api-key' => env('BREVO_A   PI_KEY'),  // Fetch API key from environment variables
                    'content-type' => 'application/json',
                ],
                'json' => [
                    'sender' => [
                        'name' => 'RadAi',
                        'email' => 'vicemmanuel7@gmail.com',
                    ],
                    'to' => [
                        [
                            'email' => $user->email,
                            'name' => $user->firstname,
                        ],
                    ],
                    'subject' => 'Your OTP Code',
                    'htmlContent' => "<html><body><p>Hello {$user->firstname},</p><p>Your OTP code is: <strong>{$otp}</strong></p><p>This code is valid for 10 minutes.</p></body></html>",
                ],
            ]);

            // Check if the request was successful
            if ($response->getStatusCode() == 201) {
                return $this->success([], 'OTP sent successfully');
            } else {
                $responseBody = $response->getBody()->getContents();
                return $this->error([], 'Failed to send OTP. Response: ' . $responseBody, 500);
            }

        } catch (\Exception $e) {
            // Return the error message to help diagnose the issue
            return $this->error([], 'Error Sending OTP: ' . $e->getMessage(), 403);
        }
    }

    public function resendOtp(Request $request)
    {
        try {
            // Validate the request to ensure user exists
            $request->validate([
                'email' => 'required|email|exists:users,email',
            ]);

            // Find the user
            $user = User::where('email', $request->input('email'))->firstOrFail();

            // Generate OTP
            $otp = rand(100000, 999999); // 6-digit OTP

            // Set OTP and expiration time (10 minutes from now)
            $user->otp = $otp;
            $user->otp_expires_at = Carbon::now()->addMinutes(10);
            $user->save();

            // Send OTP via Brevo API
            $client = new Client();
            $response = $client->post('https://api.brevo.com/v3/smtp/email', [
                'headers' => [
                    'accept' => 'application/json',
                    'api-key' => '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',
                    'content-type' => 'application/json',
                ],
                'json' => [
                    'sender' => [
                        'name' => 'RadAi',
                        'email' => 'vicemmanuel7@gmail.com',
                    ],
                    'to' => [
                        [
                            'email' => $user->email,
                            'name' => $user->firstname,  // Assuming you have a 'name' field in your User model
                        ],
                    ],
                    'subject' => 'Your OTP Code',
                    'htmlContent' => "<html><body><p>Hello {$user->firstname},</p><p>Your OTP code is: <strong>{$otp}</strong></p><p>This code is valid for 10 minutes.</p></body></html>",
                ],
            ]);

            // Check if the request was successful
            if ($response->getStatusCode() == 201) {
                return $this->success([
                ], 'OTP sent successfully',);
            } else {
                return $this->error([], 'Failed to send OTP', 500);
            }

        } catch (\Exception $e) {
            // Log the error
            // Log::error('Error sending OTP: ' . $e->getMessage());
            return $this->error([], 'Error Sending OTP', 403);        }
    }




    // Method to verify OTP
    public function verifyOtp(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || $user->otp !== $request->otp || $user->otp_expires_at->isPast()) {
            return $this->error([], 'Invalid or expired OTP', 400);
        }

        // OTP is valid
        $user->otp = null; // Clear OTP after verification
        $user->otp_expires_at = null;
        $user->email_verified_at = now(); // Mark email as verified
        $user->is_email_verified = true; // Set is_email_verified to true
        $user->save();

        return $this->success([], 'Email verified successfully');
    }

    // Method to handle forgot password (reset password)
    public function forgotPassword(Request $request)
    {

        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);
        // Find the user
        $user = User::where('email', $request->input('email'))->firstOrFail();

        if (!$user) {
            return $this->error([], 'User not found', 404);
        }

        return $this->sendOtp($user);
    }

    // Method to reset password using OTP
    public function resetPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || $user->otp !== $request->otp || $user->otp_expires_at->isPast()) {
            return $this->error([], 'Invalid or expired OTP', 400);
        }

        // Reset password
        $user->password = Hash::make($request->password);
        $user->otp = null; // Clear OTP after reset
        $user->otp_expires_at = null;
        $user->save();

        return $this->success([], 'Password reset successfully');
    }

    public function authenticated(Request $request, $user)
    {
        $sessionId = session()->getId();

        // Check if a guest cart exists
        $guestCart = Cart::where('session_id', $sessionId)->first();

        if ($guestCart) {
            // Check if the user already has a cart
            $userCart = Cart::firstOrCreate(['user_id' => $user->id]);

            // Move items from guest cart to user cart
            foreach ($guestCart->items as $item) {
                $userCartItem = $userCart->items()->where('product_id', $item->product_id)->first();
                if ($userCartItem) {
                    $userCartItem->quantity += $item->quantity;
                    $userCartItem->save();
                } else {
                    $userCart->items()->create([
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                    ]);
                }
            }

            // Delete the guest cart
            $guestCart->delete();
        }

        return redirect()->intended($this->redirectPath());
    }




}
