<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Auth\ArtistAuthController;
use App\Http\Controllers\ReviewRatingController;
use App\Http\Controllers\SongController;

// User Authentication Routes
Route::prefix('user')->group(function () {
    Route::post('/register', [UserAuthController::class, 'register']);
    Route::post('/login', [UserAuthController::class, 'login']);
    
    // Protected Routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [UserAuthController::class, 'logout']);
        Route::get('/profile', [UserAuthController::class, 'profile']);
        Route::apiResource('review_rating', ReviewRatingController::class);
    });
});

// Artist Authentication Routes
Route::prefix('artist')->group(function () {
    Route::post('/register', [ArtistAuthController::class, 'register']);
    Route::post('/login', [ArtistAuthController::class, 'login']);
    
    // Protected Routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [ArtistAuthController::class, 'logout']);
        Route::get('/profile', [ArtistAuthController::class, 'profile']);
        Route::apiResource('review_rating', ReviewRatingController::class);
        Route::apiResource('song', SongController::class);
    });
}); 
