<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PredictionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('login', [AuthenticationController::class, 'login']);
Route::post('register', [AuthenticationController::class, 'register']);
Route::post('resendOtp', [AuthenticationController::class, 'resendOtp']);
Route::post('verifyOtp', [AuthenticationController::class, 'verifyOtp']);
Route::post('forgotPassword', [AuthenticationController::class, 'forgotPassword']);
Route::post('resetPassword', [AuthenticationController::class, 'resetPassword']);

Route::get('blog', [BlogController::class, 'fetchAllBlogs']);

Route::middleware(['jwt.verify'])->group(function () {
    Route::post('predict', [PredictionController::class, 'makePrediction']);
    Route::get('predictions', [PredictionController::class, 'predictionHistory']);
    Route::post('blog', [BlogController::class, 'store']);
    Route::post('comment', [CommentController::class, 'store']);
    Route::get('comment/{blogId}', [CommentController::class, 'fetchAllCommentsInBlog']);

    ///User
    Route::get('user/profile', [UserController::class, 'getUserProfile']);
    Route::put('user/updateProfile', [UserController::class, 'updateProfile']);
    Route::post('user/changePassword', [UserController::class, 'changePassword']);
    Route::delete('user/deleteAccount', [UserController::class, 'deleteAccount']);
    Route::post('user/updateImage', [UserController::class, 'updateProfileImage']);
});

