<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\FavouritesController;
use App\Http\Controllers\SearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Get authenticated user information
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Authentication routes
Route::post('/v1/auth/register', [AuthController::class, 'register']);
Route::post('/v1/auth/login', [AuthController::class, 'login'])->name('login');

// Protected routes (require authentication)
Route::middleware(['auth:api'])->prefix('v1')->group(function () {
    
    // Logout route
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    // Car routes
    Route::get('/cars', [CarController::class, 'index']);           // Get all cars
    Route::post('/cars', [CarController::class, 'store']);          // Store a new car
    Route::get('/cars/{car_id}', [CarController::class, 'show']);   // Show a specific car
    Route::post('/cars/{car_id}/favorite', [FavouritesController::class, 'addFavorite']); // Add or remove favorite car
    Route::get('/cars/{car_id}/favorite', [FavouritesController::class, 'isFavorite']);   // Check if car is favorite
    
    // User routes
    Route::get('/users/{user_id}', [UserController::class, 'show']);           // Show user information
    Route::get('/users/{user_id}/favorites', [FavouritesController::class, 'getUserFavorites']); // Get user's favorite cars
    
    // Search route
    Route::get('/search', [SearchController::class, 'index']); // Search for cars
});
