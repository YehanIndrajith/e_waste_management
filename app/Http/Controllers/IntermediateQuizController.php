<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IntermediateQuiz;

class IntermediateQuizController extends Controller
{
    public function index()
    {
        $quizzes = IntermediateQuiz::all();
        return view('frontend.activities.intermediate.quiz', compact('quizzes'));
    }

    public function checkAnswers(Request $request)
    {
        $correctAnswers = 0;
        $totalQuestions = IntermediateQuiz::count();
        $results = [];

        foreach ($request->answers as $questionId => $answer) {
            $quiz = IntermediateQuiz::find($questionId);

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

        return view('frontend.activities.intermediate.quiz_result', compact('correctAnswers', 'totalQuestions', 'results'));
    }
}
