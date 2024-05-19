<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Car;
use Illuminate\Support\Facades\Auth;

class FavouritesController extends Controller
{
    // Add or remove a car from user's favorites
    public function addFavorite(Request $request, $car_id)
    {
        // Get the authenticated user ID
        $userId = auth()->id();
        $user = User::find($userId);

        // Return error if user not found
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Check if the car is already in favorites
        $isFavorite = $user->favoriteCars()->where('car_id', $car_id)->exists();

        if ($isFavorite) {
            // Remove car from favorites
            $user->favoriteCars()->detach($car_id);
            return response()->json(['status' => !$isFavorite, 'message' => 'Car removed from favorites.']);
        } else {
            // Add car to favorites
            $user->favoriteCars()->attach($car_id);
            return response()->json(['status' => !$isFavorite, 'message' => 'Car added to favorites.']);
        }
    }

    // Get all favorite cars for a specific user
    public function getUserFavorites($user_id)
    {
        // Find user by ID
        $user = User::find($user_id);

        // Return error if user not found
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Retrieve user's favorite cars
        $favorites = $user->favoriteCars;

        // Return favorite cars
        return response()->json(['favorites' => $favorites]);
    }

    // Check if a car is in user's favorites
    public function isFavorite($car_id)
    {
        // Get the authenticated user ID
        $userId = Auth::id();
        $user = User::find($userId);

        // Check if the car is in user's favorites
        $isFavorited = $user->favoriteCars()->where('car_id', $car_id)->exists();

        // Return favorite status
        return response()->json([
            'status' => $isFavorited
        ]);
    }
}
