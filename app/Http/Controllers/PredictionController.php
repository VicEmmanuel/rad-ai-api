<?php

namespace App\Http\Controllers;

use App\Models\PredictionHistory;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Cloudinary\Cloudinary;

class PredictionController extends Controller
{
    use HttpResponses;

//    public function makePrediction(Request $request)
//    {
//        // Validate the request to ensure an image file is provided
//        $validator = Validator::make($request->all(), [
//            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048' // Adjust rules as needed
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json([
//                'status' => 'error',
//                'message' => $validator->errors()->first()
//            ], 422);
//        }
//
//        // Get the image file from the request
//        $imageFile = $request->file('image');
//
//        // Example API endpoint for making predictions
//        $endpointUrl = 'https://pneumonia-detection-api-4via.onrender.com/predict';
//
//        try {
//            // Send POST request to the prediction API with the image as a file
//            $response = Http::attach(
//                'file',  // The name of the field expected by the API
//                fopen($imageFile->getPathname(), 'r'),  // Open the file
//                $imageFile->getClientOriginalName() // Original file name (optional, but good practice)
//            )->post($endpointUrl);
//
//
//            // Check if the request was successful (status code 200-299)
//            $responseData = $response->json();
//            if ( $responseData['status'] == "success"
////                $response->successful()
//) {
////                $responseData = $response->json(); // Decode the JSON response
//
//
//                // Move the image to the 'predictions' directory
//                $newImageName = uniqid() . '.' . $imageFile->extension();
//                $imageFile->move(public_path('predictions'), $newImageName);
//
//                // Save prediction history if the user is authenticated
//                if (auth()->check()) {
//                    $userId = auth()->user()->id;
//
//                    PredictionHistory::create([
//                        'user_id' => $userId,
//                        'image' => $newImageName,
//                        'prediction_class' => $responseData['data']['class'],
//                        'confidence' => $responseData['data']['confidence']
//                    ]);
//                }
//
//                // Return the response from the API
//                return response()->json([
//                    'status' => 'success',
//                    'message' => 'Prediction made successfully',
//                    'data' => $responseData['data']
//                ], 200);
//
//            } else {
//                // Handle API error responses
//                $errorMessage = $response->json()['message'] ?? 'Unknown error';
//                return response()->json([
//                    'status' => 'error',
//                    'message' => 'Prediction failed: ' . $errorMessage
//                ], $response->status());
//            }
//
//        } catch (\Exception $e) {
//            // Handle any exceptions during the API call
//            return response()->json([
//                'status' => 'error',
//                'message' => 'An error occurred: ' . $e->getMessage()
//            ], 500);
//        }
//    }

    public function makePrediction(Request $request)
    {
        // Validate the request to ensure an image file is provided
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048' // Adjust rules as needed
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ], 422);
        }

        // Get the image file from the request
        $imageFile = $request->file('image');

        // Example API endpoint for making predictions
        $endpointUrl = 'https://pneumonia-detection-api-4via.onrender.com/predict';

        try {
            // Send POST request to the prediction API with the image as a file
            $response = Http::attach(
                'file',  // The name of the field expected by the API
                fopen($imageFile->getPathname(), 'r'),  // Open the file
                $imageFile->getClientOriginalName() // Original file name (optional, but good practice)
            )->post($endpointUrl);

            // Check if the request was successful (status code 200-299)
            $responseData = $response->json();
            if ($responseData['status'] == "success") {

                // Upload the image to Cloudinary
                $cloudinaryUpload = cloudinary()->upload($imageFile->getRealPath(), [
                    'folder' => 'predictions'
                ]);
                $cloudinaryUrl = $cloudinaryUpload->getSecurePath();  // Get the URL of the uploaded image

                // Save prediction history if the user is authenticated
                if (auth()->check()) {
                    $userId = auth()->user()->id;

                    PredictionHistory::create([
                        'user_id' => $userId,
                        'image' => $cloudinaryUrl,  // Store Cloudinary URL
                        'prediction_class' => $responseData['data']['class'],
                        'confidence' => $responseData['data']['confidence']
                    ]);
                }

                // Return the response from the API
                return response()->json([
                    'status' => 'success',
                    'message' => 'Prediction made successfully',
                    'data' => $responseData['data'],
                    'image_url' => $cloudinaryUrl // Return Cloudinary URL in response
                ], 200);

            } else {
                // Handle API error responses
                $errorMessage = $response->json()['message'] ?? 'Unknown error';
                return response()->json([
                    'status' => 'error',
                    'message' => 'Prediction failed: ' . $errorMessage
                ], $response->status());
            }

        } catch (\Exception $e) {
            // Handle any exceptions during the API call
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }

//    public function predictionHistory(Request $request)
//    {
//        $user = Auth::user();
//
//        $page = $request->input('page', 1);
//        $pageSize = $request->input('pageSize', 10);
//
//        // Define the base URL for your public images
//        $imageBaseUrl = asset('predictions'); // Adjust based on your public image path
//
//        // Paginate the transactions
//        $history = PredictionHistory::where('user_id', $user->id)
//            ->orderBy('created_at', 'DESC')
//            ->paginate($pageSize, ['*'], 'page', $page);
//
//        // Transform the history items to include the full image URL
//        $historyItems = $history->map(function ($item) use ($imageBaseUrl) {
//            $item->image = $imageBaseUrl . '/' . $item->image; // Construct the full image URL
//            return $item;
//        });
//
//        // Check if there are more records
//        $hasNextRecord = $history->currentPage() < $history->lastPage();
//
//        return $this->success([
//            'hasNextRecord' => $hasNextRecord,
//            'totalCount' => $history->total(),
//            'history' => $historyItems,
//        ], 'Prediction history retrieved successfully', 200);
//    }
    public function predictionHistory(Request $request)
    {
        $user = Auth::user();

        $page = $request->input('page', 1);
        $pageSize = $request->input('pageSize', 10);

        // Paginate the transactions
        $history = PredictionHistory::where('user_id', $user->id)
            ->orderBy('created_at', 'DESC')
            ->paginate($pageSize, ['*'], 'page', $page);

        // Transform the history items (No need to modify the image URL as it's already a Cloudinary URL)
        $historyItems = $history->map(function ($item) {
            return $item; // The image URL stored in the 'image' field is already the Cloudinary URL
        });

        // Check if there are more records
        $hasNextRecord = $history->currentPage() < $history->lastPage();

        return $this->success([
            'hasNextRecord' => $hasNextRecord,
            'totalCount' => $history->total(),
            'history' => $historyItems,
        ], 'Prediction history retrieved successfully', 200);
    }

}
