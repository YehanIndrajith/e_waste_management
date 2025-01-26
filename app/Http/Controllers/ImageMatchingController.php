<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImageMatching;


class ImageMatchingController extends Controller
{
    // Show the image matching form
    public function showImageMatchingForm()
    {
        $images = ImageMatching::all();
        return view('frontend.activities.beginner.image-matching', compact('images'));
    }


}


