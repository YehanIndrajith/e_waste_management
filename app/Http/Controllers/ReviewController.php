<?php

namespace App\Http\Controllers;

use App\Models\CollectionPoint;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index($collectionPointId)
    {
        $collectionPoint = CollectionPoint::findOrFail($collectionPointId);
        $reviews = Review::where('collection_point_id', $collectionPointId)
                        ->orderBy('created_at', 'desc')
                        ->take(5)
                        ->get();

        return view('frontend.reviews.index', compact('collectionPoint', 'reviews'));
    }

    public function store(Request $request, $collectionPointId)
    {
        $request->validate([
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Review::create([
            'user_id' => auth()->id(),
            'collection_point_id' => $collectionPointId,
            'review' => $request->review,
            'rating' => $request->rating,
        ]);

        return redirect()->route('reviews.index', $collectionPointId)->with('success', 'Review added successfully!');
    }

    
}
