<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class SearchController extends Controller
{
    // Search for cars based on make and/or model
    public function search(Request $request)
    {
        $make = $request->input('make');
        $model = $request->input('model');

        // Initialize the query
        $query = Car::query();

        // Add condition for 'make' if provided
        if ($make) {
            $query->where('make', 'LIKE', "%$make%");
        }

        // Add condition for 'model' if provided
        if ($model) {
            $query->where('model', 'LIKE', "%$model%");
        }

        // Execute the query and get results
        $result = $query->get();

        // Return the search results
        return response()->json(['cars' => $result]);
    }
}
