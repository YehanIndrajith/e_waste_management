<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BeginnerQuiz;

class BeginnerQuizController extends Controller
{
    public function index()
    {
        $quizzes = BeginnerQuiz::all();
        return view('frontend.activities.beginner.quiz', compact('quizzes'));
    }

    public function checkAnswers(Request $request)
    {
        $correctAnswers = 0;
        $totalQuestions = BeginnerQuiz::count();
        $results = [];

        foreach ($request->answers as $questionId => $answer) {
            $quiz = BeginnerQuiz::find($questionId);

            if ($quiz && $quiz->correct_option == $answer) {
                $correctAnswers++;
            }

            $results[] = [
                'question' => $quiz->question,
                'user_answer' => $answer,
                'correct_answer' => $quiz->correct_option,
                'is_correct' => $quiz->correct_option == $answer,
            ];
        }

        return view('frontend.activities.beginner.quiz_result', compact('correctAnswers', 'totalQuestions', 'results'));
    }
}
