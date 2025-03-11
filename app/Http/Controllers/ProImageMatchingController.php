<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImageMatching;

class ProImageMatchingController extends Controller
{
    public function showImageMatchingForm()
    {
        // Load images starting from 13th image (adjust as needed)
        $images = ImageMatching::skip(12)->take(8)->get();
        return view('frontend.activities.pro.image-matching', compact('images'));
    }
}
