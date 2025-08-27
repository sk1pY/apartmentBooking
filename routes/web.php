<?php

use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Apartment;

use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\profile\ApartmentController as ProfileApartmentController;
use App\Http\Controllers\profile\BookingController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CommentController;

Route::get('/', [CityController::class, 'index']);

Route::get('/apartments/{apartment}', [ApartmentController::class, 'show'])->name('apartments.show');

Route::post('/apartments/{apartment}/booking', [BookingController::class, 'store'])->name('booking.store');

Route::prefix('profile')->name('profile.')->middleware('auth')->group(function () {
    Route::get('/', [UserController::class, 'profile'])->name('index');

    Route::resource('bookings', BookingController::class);
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');
    Route::delete('/bookmark/{bookmark}', [BookmarkController::class, 'destroy'])->name('bookmarks.destroy');

    Route::resource('apartments', ProfileApartmentController::class);
});

//bookmark

Route::post('/apartments/{apartment}/bookmark', [BookmarkController::class, 'store'])->name('bookmark.store');
Route::resource('apartments.comments', CommentController::class);
Route::get('/search', SearchController::class)->name('search');
Route::get('/city/{city}', [CityController::class, 'show'])->name('city.show');
