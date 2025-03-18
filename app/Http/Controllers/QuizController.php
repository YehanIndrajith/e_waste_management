<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;
use App\Models\Quiz1Result;


class QuizController extends Controller
{
    public function index()
    {
        $existingResult = Quiz1Result::where('username', Auth::user()->username)->first();

        if ($existingResult) {
            // If the user has already taken the quiz, redirect or display a message
            return redirect()->route('user.dashboard')->with('error', 'You have already completed this quiz.');
        }
         

        $quizzes = Quiz::all();
        return view('frontend.quiz.index', compact('quizzes'));
    }

    public function checkAnswers(Request $request)
    {  
     

        // Validate the request data
        $request->validate([
            'answers' => 'required|array', // Ensure 'answers' is provided and is an array
            'answers.*' => 'in:A,B,C,D',  // Ensure each answer is one of the allowed options
        ]);

        $totalQuestions = Quiz::count();
        $correctAnswers = 0;
        $results = [];

        foreach ($request->answers as $questionId => $answer) {
            $quiz = Quiz::find($questionId);

            // Ensure the question exists and handle missing data gracefully
            if (!$quiz) {
                continue;
            }

            $isCorrect = $quiz->correct_option === $answer;
            $results[] = [
                'question' => $quiz->question,
                'user_answer' => $answer,
                'correct_answer' => $quiz->correct_option,
                'is_correct' => $isCorrect,
                'option_a' => $quiz->option_a,
                'option_b' => $quiz->option_b,
                'option_c' => $quiz->option_c,
                'option_d' => $quiz->option_d,
            ];

            if ($isCorrect) {
                $correctAnswers++;
            }
        }

        // Determine Knowledge Level
        $level = '';
        if ($correctAnswers <= 4) {
            $level = 'Beginner';
        } elseif ($correctAnswers <= 7) {
            $level = 'Intermediate';
        } else {
            $level = 'Pro';
        }

         // Store results in the database
    Quiz1Result::create([
        'username' => Auth::user()->username, // Store the username
        'level' => $level,
        'marks' => $correctAnswers,
    ]);

        return view('frontend.quiz.result', compact('correctAnswers', 'totalQuestions', 'level', 'results'));
    }
}
