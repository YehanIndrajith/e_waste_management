<?php

namespace App\Http\Controllers;

use App\Models\ProTriviaQuiz;
use Illuminate\Http\Request;

class ProTriviaQuizController extends Controller
{
    public function index()
    {
        $questions = ProTriviaQuiz::inRandomOrder()->limit(5)->get();
        return view('frontend.activities.pro.trivia', compact('questions'));
    }

    public function checkAnswers(Request $request)
    {
        $score = 0;
        $totalQuestions = count($request->answers);

        foreach ($request->answers as $questionId => $selectedAnswer) {
            $correctAnswer = ProTriviaQuiz::find($questionId)->correct_answer;
            if ($selectedAnswer === $correctAnswer) {
                $score++;
            }
        }

        return view('frontend.activities.pro.trivia-result', compact('score', 'totalQuestions'));
    }
}
