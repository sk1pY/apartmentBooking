<?php

use App\Http\Controllers\api\v1\AuthController;
use App\Http\Controllers\api\v1\CommentController as ApartmentCommentController;
use App\Http\Controllers\api\v1\profile\ApartmentController;
use App\Http\Controllers\api\v1\profile\BookingController;
use App\Http\Controllers\api\v1\profile\CommentController as HomeCommentController;
use App\Http\Controllers\api\v1\UserController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('users', UserController::class);
    Route::post('/apartments/{apartment}/booking', [BookingController::class, 'store']);

    Route::prefix('/profile')->group(function () {
        Route::apiResource('apartments', ApartmentController::class)->except('show');
        Route::get('/apartments/{apartment}/bookings', [ApartmentController::class, 'apartmentBookings']);
        Route::apiResource('bookings', BookingController::class)->except(['store']);
        //Comments
        Route::apiResource('comments', HomeCommentController::class)->except(['store', 'show']);
    });

    //Comments
    Route::apiResource('apartments.comments', ApartmentCommentController::class)->except(['show']);


});

