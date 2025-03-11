<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Quiz1Result;
use App\Models\QuizScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index(){
        $quizResults = Quiz1Result::where('username', Auth::user()->username)
        ->orderBy('level', 'asc') // Order results by level (optional)
        ->get();

        $quiz2Results = QuizScore::where('user_id', auth()->id())->with('user')->get();


       
    // Pass the results to the view
    return view('frontend.dashboard.dashboard', compact('quizResults','quiz2Results'));
    }
}
