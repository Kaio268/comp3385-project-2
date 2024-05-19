<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Show user details
    public function show($user_id)
    {
        // Find user by ID
        $user = User::find($user_id);

        // Return error if user not found
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Return user details
        return response()->json(['user' => $user]);
    }

    // Get user's favorite items
    public function favorites($user_id)
    {
        // Find user by ID
        $user = User::find($user_id);

        // Return error if user not found
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Retrieve user's favorites
        $favorites = $user->favorites;

        // Return user's favorites
        return response()->json(['favorites' => $favorites]);
    }
}
