<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CollectionPoint;
use App\Models\Review; // Import the Review model to fetch ratings
use Illuminate\Support\Facades\DB;

class CollectionPointController extends Controller
{
    /**
     * Display a list of all collection points.
     */
    public function index()
    {
        // Retrieve collection points with their average ratings
        $collectionPoints = CollectionPoint::all(); // Fetch all collection points
        return view('frontend.show-collection-points.index', compact('collectionPoints'));
         

    
    }
    
    /**
     * Find the nearest certified collection point based on the user's location.
     */
    public function findNearest(Request $request)
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        // Find the nearest collection point using Haversine formula (distance in km)
        $nearestPoint = CollectionPoint::select('*')
            ->selectRaw('(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance', 
                [$latitude, $longitude, $latitude])
            ->orderBy('distance')
            ->first();

        if ($nearestPoint) {
            // Fetch the average rating for the nearest collection point
            $averageRating = Review::where('collection_point_id', $nearestPoint->id)->avg('rating') ?? 0;

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $nearestPoint->id,
                    'name' => $nearestPoint->name,
                    'address' => $nearestPoint->address,
                    'contact_info' => $nearestPoint->contact_info,
                    'latitude' => $nearestPoint->latitude,
                    'longitude' => $nearestPoint->longitude,
                    'average_rating' => round($averageRating, 1) // Round to 1 decimal place
                ]
            ]);
        }

        return response()->json(['success' => false, 'message' => 'No collection points found.']);
    }
}
