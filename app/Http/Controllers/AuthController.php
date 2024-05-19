<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // Register a new user
    public function register(Request $request)
    {
        // Validate incoming request
        $validator = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'location' => 'required|string',
            'biography' => 'required|string',
            'photo' => 'required|file|image',
        ]);

        // Handle user photo upload
        $userPhoto = $request->file('photo');
        $fileName = time() . '.' . $userPhoto->getClientOriginalExtension(); 
        $path = $userPhoto->storeAs('usersphoto', $fileName, 'public');

        // Create new user instance
        $user = new User();
        $user->name = $request->input('name');
        $user->password = $request->input('password');
        $user->location = $request->input('location');
        $user->biography = $request->input('biography');
        $user->email = $request->input('email');
        $user->photo = asset('storage/' . $path);
        $user->save();

        // Return success response
        return response()->json(['message' => 'User registered successfully'], 201);
    }

    /**
     * Handle user login and return a JWT.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // Extract credentials from request
        $credentials = $request->only('email', 'password');

        // Attempt to authenticate and generate token
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Retrieve authenticated user
        $user = Auth::user();
        $userId = $user->id;

        // Return success response with token and user ID
        return response()->json([
            'message' => 'Login Successful!',
            'access_token' => $token,
            'user_id' => $userId
        ], 200);
    }

    /**
     * Log the user out and invalidate the token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        // Invalidate the token
        auth()->logout();
        Session::flush();

        // Return success response
        return response()->json(['message' => 'Successfully logged out']);
    }   
}
