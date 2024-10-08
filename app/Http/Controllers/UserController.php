<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    use HttpResponses;

    public function getUserProfile(Request $request)
    {
        try {
            // Attempt to get the authenticated user
            $user = JWTAuth::parseToken()->authenticate();

            // Generate a new token for the authenticated user
            $token = JWTAuth::fromUser($user);

            // Add the profile image URL to the user object if it exists
            $user->profile_image = $user->profile_image ? url('profile_images/' . $user->profile_image) : null;

            // Return the user profile and token
            return $this->success([
                'user' => $user,
                'access_token' => $token,
            ], 'User profile retrieved successfully');
        } catch (TokenInvalidException $e) {
            // Handle token invalid exception
            return $this->error([], 'Invalid token. Please authenticate again.', 401);
        } catch (TokenExpiredException $e) {
            // Handle token expired exception
            return $this->error([], 'Token has expired. Please authenticate again.', 401);
        } catch (TokenBlacklistedException $e) {
            // Handle token blacklisted exception
            return $this->error([], 'Token is blacklisted. Please authenticate again.', 401);
        } catch (\Exception $e) {
            // Handle other exceptions
            return $this->error([], 'Unauthorized access. Please log in again.', 401);
        }
    }



    public function updateProfile(Request $request)
    {
//        dd($request->all()); // Dump and die to inspect the request data

        // Validate the request
        $validator = Validator::make($request->all(), [
            'firstname' => 'sometimes|string|max:255',
            'lastname' => 'sometimes|string|max:255',
//            'phone' => 'sometimes|string|max:255',
//            'email' => 'sometimes|string|email|max:255|unique:users,email,' . auth()->id(),
        ]);

        if ($validator->fails()) {
            return $this->error([], $validator->errors()->first(), 403);
        }

        // Get the authenticated user
        $user = JWTAuth::parseToken()->authenticate();

        // Update user details
        $user->update($request->only(['firstname', 'lastname',]));

        return $this->success([
//            'user' => $user,
        ], 'Profile updated successfully');
    }


    public function changePassword(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'currentPassword' => 'required|string',
            'newPassword' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->error([], $validator->errors()->first(), 403);
        }

        // Get the authenticated user
        $user = JWTAuth::parseToken()->authenticate();

        // Check if the current password is correct
        if (!Hash::check($request->currentPassword, $user->password)) {
            return $this->error([], 'Current password is incorrect', 403);
        }

        // Update the password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return $this->success([], 'Password changed successfully');
    }

    public function updateProfileImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);

        if ($validator->fails()) {
            return $this->error([], $validator->errors()->first(), 403);
        }

        $user = Auth::user();

        // Handle the profile image upload
        if ($request->hasFile('profile_image')) {
            try {
                // Generate a unique name for the image
                $imageName = uniqid() . '.' . $request->profile_image->extension();
                // Move the image to the public directory
                $request->profile_image->move(public_path('profile_images'), $imageName);
                // Save the image path to the user's profile
                $user->profile_image = $imageName;
                $user->save();

                return $this->success([
                    'profile_image' => url('profile_images/' . $imageName),
                ], 'Profile image updated successfully', 200);

            } catch (\Exception $e) {
                // Catch and handle any exceptions during the file upload
                return $this->error([], 'Profile image upload failed: ' . $e->getMessage(), 500);
            }
        }

        return $this->error([], 'No profile image provided', 400);
    }


    public function deleteAccount(Request $request)
    {
        // Get the authenticated user
        $user = JWTAuth::parseToken()->authenticate();

        // Delete the user account
        $user->delete();

        return $this->success([], 'Account deleted successfully');
    }
}
