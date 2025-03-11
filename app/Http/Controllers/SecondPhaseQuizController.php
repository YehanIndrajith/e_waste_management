<?php

namespace App\Http\Controllers;

use App\Models\Quiz1Result;
use Illuminate\Http\Request;
use App\Models\QuizScore;
use Illuminate\Support\Facades\Auth;

class SecondPhaseQuizController extends Controller
{
    /**
     * Display the quiz based on the user level.
     */
    public function showQuiz()
    {
        
        $user = Auth::user();
      
        $result = Quiz1Result::where('username', $user->username)
                         ->orderBy('marks', 'desc')
                         ->first();
        

        if ($result) {
            // Determine user level based on marks
            if ($result->marks <= 4) {
                $userLevel = 'beginner';
            } elseif ($result->marks <= 7) {
                $userLevel = 'intermediate';
            } else {
                $userLevel = 'pro';
            }

            // Load quiz based on user level
            switch ($userLevel) {
                case 'beginner':
                    return $this->loadBeginnerQuiz();
                case 'intermediate':
                    return $this->loadIntermediateQuiz();
                case 'pro':
                    return $this->loadProQuiz();
                default:
                    return redirect()->back()->with('error', 'Invalid user level');
            }
        } else {
            return redirect()->back()->with('error', 'No quiz results found');
        }
    }
    
    public function showBeginnerQuiz()
    {
        $questions = [
            ['question' => 'Which of the following is a safe way to dispose of e-waste?', 'options' => ['Burn it', 'Recycle at a certified facility', 'Throw it in the trash', 'Bury it'], 'correct' => 'Recycle at a certified facility'],
            ['question' => 'How can you reduce your e-waste footprint?', 'options' => ['Buy new electronics frequently', 'Donate or sell old devices', 'Throw electronics in the trash', 'Ignore e-waste issues'], 'correct' => 'Donate or sell old devices'],
            ['question' => 'What harmful effect can e-waste have on the environment?', 'options' => ['It can improve air quality', 'It can release toxic chemicals into the soil and water', 'It increases the fertility of land', 'It has no impact on the environment'], 'correct' => 'It can release toxic chemicals into the soil and water'],
            ['question' => 'Which symbol indicates that an electronic device should not be thrown in the trash?', 'options' => ['Recycling arrows', 'Trash can with a line through it', 'Green tree symbol', 'Recycle bin icon'], 'correct' => 'Trash can with a line through it'],
            ['question' => 'What should you do with an old mobile phone you no longer use?', 'options' => ['Throw it away', 'Recycle it or donate it', 'Store it in a drawer forever', 'Disassemble it yourself'], 'correct' => 'Recycle it or donate it'],
            ['question' => 'What is the main reason e-waste needs to be recycled?', 'options' => ['To save space at home', 'To prevent environmental harm from hazardous materials', 'To make room for new products', 'To increase landfill capacity'], 'correct' => 'To prevent environmental harm from hazardous materials'],
            ['question' => 'Which organization is responsible for e-waste recycling in most countries?', 'options' => ['Local grocery stores', 'Government agencies and certified recycling centers', 'Hardware stores', 'Schools'], 'correct' => 'Government agencies and certified recycling centers'],
            ['question' => 'How can e-waste recycling help reduce the demand for raw materials?', 'options' => ['By creating more waste', 'By reusing valuable materials like metals from old electronics', 'By destroying electronics', 'By making more landfills available'], 'correct' => 'By reusing valuable materials like metals from old electronics'],
            ['question' => 'What type of battery is commonly found in e-waste and can be hazardous?', 'options' => ['Lead-acid batteries', 'Zinc batteries', 'Alkaline batteries', 'Paper batteries'], 'correct' => 'Lead-acid batteries'],
            ['question' => 'What symbol typically indicates an electronic device can be recycled?', 'options' => ['A trash can', 'Recycling arrows', 'A lightbulb', 'A triangle with an "X"'], 'correct' => 'Recycling arrows'],
        ];
    
        return view('frontend.activities.beginner.second-phase-quiz', compact('questions'));
    }
    
    public function showIntermediateQuiz()
    {
        $questions = [
            ['question' => 'Which part of e-waste is most hazardous to human health?', 'options' => ['Plastic casing', 'Batteries containing lead or cadmium', 'Metal screws', 'Rubber seals'], 'correct' => 'Batteries containing lead or cadmium'],
            ['question' => 'How does improper e-waste disposal contribute to pollution?', 'options' => ['It cleans rivers and lakes', 'It releases harmful chemicals like mercury and lead into the environment', 'It improves air quality', 'It has no measurable effect'], 'correct' => 'It releases harmful chemicals like mercury and lead into the environment'],
        ];
    
        return view('frontend.activities.intermediate.second-phase-quiz', compact('questions'));
    }
    
    public function showProQuiz()
    {
        $questions = [
            ['question' => 'How can implementing a circular economy help reduce global e-waste?', 'options' => ['By promoting constant production of new electronics', 'By encouraging reuse, repair, and recycling of products to extend their lifecycle', 'By exporting all e-waste to other countries', 'By stopping the use of electronics altogether'], 'correct' => 'By encouraging reuse, repair, and recycling of products to extend their lifecycle'],
            ['question' => 'What is the role of Extended Producer Responsibility (EPR) in e-waste management?', 'options' => ['It holds consumers accountable for managing e-waste', 'It requires manufacturers to take responsibility for the disposal of their products', 'It encourages companies to produce more electronics', 'It only applies to recycled paper products'], 'correct' => 'It requires manufacturers to take responsibility for the disposal of their products'],
        ];
    
        return view('frontend.activities.pro.second-phase-quiz', compact('questions'));
    }
    

    public function submitBeginnerQuiz(Request $request)
    {
        $user = Auth::user();
    
        // Prevent re-submission
        if (QuizScore::where('user_id', $user->id)->where('level', 'beginner')->exists()) {
            return redirect()->route('user.dashboard')->with('error', 'You have already attempted this quiz.');
        }
    
        // Ensure `answers` exists in the request
        $submittedAnswers = $request->input('answers', []);
    
        // Fetch correct answers
        $correctAnswers = [
            '0' => 'Recycle at a certified facility',
            '1' => 'Donate or sell old devices',
            '2' => 'It can release toxic chemicals into the soil and water',
            '3' => 'Trash can with a line through it',
            '4' => 'Recycle it or donate it',
            '5' => 'To prevent environmental harm from hazardous materials',
            '6' => 'Government agencies and certified recycling centers',
            '7' => 'By reusing valuable materials like metals from old electronics',
            '8' => 'Lead-acid batteries',
            '9' => 'Recycling arrows',
        ];
    
        $score = 0;
        foreach ($correctAnswers as $key => $correctAnswer) {
            if (isset($submittedAnswers[$key]) && $submittedAnswers[$key] === $correctAnswer) {
                $score++;
            }
        }
    
        // Save score in database
        QuizScore::create([
            'user_id' => $user->id,
            'level' => 'beginner',
            'score' => $score,
            'completed' => true
        ]);
    
        return redirect()->route('user.dashboard')->with('success', "You scored $score out of " . count($correctAnswers));
    }
    

    
}
