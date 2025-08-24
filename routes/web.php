<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Apartment;

use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\profile\BookingController;
use App\Http\Controllers\SearchController;

Route::get('/', [CityController::class, 'index']);

Route::get('/apartments/{apartment}', [ApartmentController::class, 'show'])->name('apartments.show');

Route::post('/apartments/{apartment}/booking', [BookingController::class, 'store'])->name('booking.store');

Route::prefix('profile')->name('profile.')->middleware('auth')->group(function () {
    Route::get('/', [UserController::class, 'profile'])->name('index');

    Route::resource('bookings', BookingController::class);

});


Route::get('/search',SearchController::class)->name('search');

Route::get('/city/{city}', [CityController::class, 'show'])->name('city.show');
