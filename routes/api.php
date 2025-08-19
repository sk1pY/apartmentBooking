<?php

use App\Http\Controllers\api\v1\AuthController;
use App\Http\Controllers\api\v1\UserController;
use App\Http\Controllers\api\v1\ApartmentController;
use App\Http\Controllers\api\v1\BookingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('users', UserController::class);
    Route::apiResource('apartments', ApartmentController::class);
    Route::post('/apartments/{apartment}/booking', [BookingController::class, 'store']);
    Route::apiResource('bookings', BookingController::class)->except(['store']);

});

