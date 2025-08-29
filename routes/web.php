<?php

use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\profile\ApartmentController as ProfileApartmentController;
use App\Http\Controllers\profile\BookingController;
use App\Http\Controllers\profile\UserController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CityController::class, 'index'])->name('index');

Route::get('/apartments/{apartment}', [ApartmentController::class, 'show'])->name('apartments.show');

Route::post('/apartments/{apartment}/booking', [BookingController::class, 'store'])->name('booking.store');

Route::prefix('profile')->name('profile.')->middleware('auth')->group(function () {

    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/edit', [UserController::class, 'edit'])->name('edit');
    Route::put('/', [UserController::class, 'update'])->name('update');
    Route::delete('/', [UserController::class, 'destroy'])->name('destroy');
    Route::resource('bookings', BookingController::class);
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');
    Route::delete('/bookmarks/{bookmark}', [BookmarkController::class, 'destroy'])->name('bookmarks.destroy');

    Route::resource('apartments', ProfileApartmentController::class);
});

//bookmark

Route::post('/apartments/{apartment}/bookmark', [BookmarkController::class, 'store'])->name('bookmark.store');
Route::resource('apartments.comments', CommentController::class);
Route::get('/search', SearchController::class)->name('search');
Route::get('/city/{city}', [CityController::class, 'show'])->name('city.show');
