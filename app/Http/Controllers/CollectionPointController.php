<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CollectionPoint;

class CollectionPointController extends Controller
{
    public function index()
    {
        $collectionPoints = CollectionPoint::all();
        return view('frontend.collection-points.index', compact('collectionPoints'));
    }

    public function findNearest(Request $request)
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
    
        $nearestPoint = CollectionPoint::select('*')
            ->selectRaw('(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance', [$latitude, $longitude, $latitude])
            ->orderBy('distance')
            ->first();
    
        if ($nearestPoint) {
            return response()->json([
                'success' => true,
                'data' => $nearestPoint
            ]);
        }
    
        return response()->json(['success' => false, 'message' => 'No collection points found.']);
    }
    
    
}
