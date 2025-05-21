<?php

namespace App\Http\Controllers;

use App\Models\ImageMatching;
use Illuminate\Http\Request;

class IntermediateImageMatchingQuizController extends Controller
{
    public function showImageMatchingForm()
    {
      // Fetch the specific range of images (skip the first 6, take the next 6)
      $images = ImageMatching::orderBy('id') // Ensure consistent ordering
      ->skip(6)                         // Skip the first 6 rows
      ->take(6)                         // Take the next 6 rows
      ->get();

  return view('frontend.activities.intermediate.image-matching', compact('images'));
    }

}
