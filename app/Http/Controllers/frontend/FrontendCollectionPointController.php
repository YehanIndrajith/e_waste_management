<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CollectionPoint;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FrontendCollectionPointController extends Controller
{
    public function index()
    {
        // Retrieve all collection points with their average ratings
        $collectionPoints = CollectionPoint::leftJoin('reviews', 'collection_points.id', '=', 'reviews.collection_point_id')
            ->select('collection_points.*', DB::raw('COALESCE(AVG(reviews.rating), 0) as avg_rating'))
            ->groupBy('collection_points.id')
            ->get();
    
        return view('frontend.show-collection-points.index', compact('collectionPoints'));
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
