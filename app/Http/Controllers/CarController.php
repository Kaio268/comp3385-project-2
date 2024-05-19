<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    // Fetch all cars
    public function index()
    {
        // Retrieve all cars
        $cars = Car::all();
        return response()->json(['cars' => $cars]);
    }

    // Store a new car
    public function store(Request $request)
    {
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'colour' => 'required|string|max:255',
            'year' => 'required|string|max:255',
            'transmission' => 'required|string|max:255',
            'car_type' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'photo' => 'nullable|image',
        ]);

        // Return validation errors if any
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Create new car instance and fill details
        $car = new Car();
        $car->user_id = auth()->id();
        $car->make = $request->make;
        $car->model = $request->model;
        $car->colour = $request->colour;
        $car->year = $request->year;
        $car->transmission = $request->transmission;
        $car->car_type = $request->car_type;
        $car->price = $request->price;
        $car->description = $request->description;

        // Handle car photo upload if provided
        if ($request->hasFile('photo')) {
            $fileName = time() . '.' . $request->photo->getClientOriginalExtension();
            $path = $request->photo->storeAs('carsphoto', $fileName, 'public');
            $car->photo = Storage::url($path);
        }

        // Save the car to the database
        $car->save();

        // Return success response
        return response()->json(['message' => 'Car created successfully!', 'car' => $car], 201);
    }

    // Show a specific car
    public function show($car_id)
    {
        // Find car by ID
        $car = Car::find($car_id);
        
        // Return error if car not found
        if (!$car) {
            return response()->json(['error' => 'Car not found'], 404);
        }

        // Return car details
        return response()->json(['car' => $car]);
    }

    // Update a car
    public function update(Request $request, $id)
    {
        // Find car by ID
        $car = Car::find($id);

        // Return error if car not found
        if (!$car) {
            return response()->json(['error' => 'Car not found'], 404);
        }

        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'make' => 'string|max:255',
            'model' => 'string|max:255',
            'colour' => 'string|max:255',
            'year' => 'string|max:255',
            'transmission' => 'string|max:255',
            'car_type' => 'string|max:255',
            'price' => 'numeric',
            'description' => 'string',
            'photo' => 'image',
        ]);

        // Return validation errors if any
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Update car details
        $car->update($request->all());

        // Handle car photo upload if provided
        if ($request->hasFile('photo')) {
            $fileName = time() . '.' . $request->photo->getClientOriginalExtension();
            $path = $request->photo->storeAs('carsphoto', $fileName, 'public');
            $car->photo = Storage::url($path);
        }

        // Return success response
        return response()->json(['message' => 'Car updated successfully!', 'car' => $car]);
    }

    // Delete a car
    public function destroy($id)
    {
        // Find car by ID
        $car = Car::find($id);

        // Return error if car not found
        if (!$car) {
            return response()->json(['error' => 'Car not found'], 404);
        }

        // Delete the car from the database
        $car->delete();

        // Return success response
        return response()->json(['message' => 'Car deleted successfully']);
    }
}
