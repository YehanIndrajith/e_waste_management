<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Quiz1Result;
use App\Models\QuizScore;

class SecondPhaseQuizController extends Controller
{
    public function showQuiz()
    {
        $user = Auth::user();
    
        $result = Quiz1Result::where('username', $user->username)
            ->orderBy('marks', 'desc')
            ->first();

            if ($result) {
                // If the user has already taken the quiz, redirect or display a message
                return redirect()->route('user.dashboard')->with('error', 'You have already completed this quiz.');
            }
    
        if ($result) {
            if ($result->marks <= 4) {
                return $this->showBeginnerQuiz();
            } elseif ($result->marks <= 7) {
                return $this->showIntermediateQuiz();
            } else {
                return $this->showProQuiz();
            }
        } else {
            return redirect()->back()->with('error', 'No quiz results found');
        }
    }

    public function showBeginnerQuiz()
    {
        $questions = $this->getBeginnerQuestions();
        return view('frontend.activities.beginner.second-phase-quiz', compact('questions'));
    }

    public function showIntermediateQuiz()
    {
        $questions = $this->getIntermediateQuestions();
        return view('frontend.activities.intermediate.second-phase-quiz', compact('questions'));
    }

    public function showProQuiz()
    {
        $questions = $this->getProQuestions();
        return view('frontend.activities.pro.second-phase-quiz', compact('questions'));
    }

    public function submitQuiz(Request $request)
    {
       
       
        $user = Auth::user();
    
        $result = Quiz1Result::where('username', $user->username)
            ->orderBy('marks', 'desc')
            ->first();
    
        if ($result) {
            if ($result->marks <= 4) {
                return $this->submitBeginnerQuiz($request,'beginner');
            } elseif ($result->marks <= 7) {
                return $this->processQuizSubmission($request, 'intermediate');
            } else {
                return $this->submitProQuiz($request, 'pro');
            }
        } else {
            return redirect()->back()->with('error', 'No quiz results found');
        } 
        
    }

    public function submitBeginnerQuiz(Request $request)
{
    return $this->processQuizSubmission($request, 'beginner');
}

public function submitIntermediateQuiz(Request $request)
{
    return $this->processQuizSubmission($request, 'intermediate');
}

public function submitProQuiz(Request $request)
{
    return $this->processQuizSubmission($request, 'pro');
}

public function processQuizSubmission(Request $request, $level)
{
    $user = Auth::user();
    $questions = $this->getQuestionsByLevel($level);
    $answers = $request->input('answers', []);
    $score = 0;

    foreach ($questions as $index => $question) {
        if (isset($answers[$index]) && $answers[$index] === $question['correct']) {
            $score++;
        }
    }

    // Store the score
    QuizScore::updateOrCreate(
        ['user_id' => $user->id, 'level' => $level],
        ['score' => $score]
    );

    return redirect()->route('user.quiz.second-phase.result')->with([
        'score' => $score,
        'total' => count($questions)
    ]);
}

    public function getQuestionsByLevel($level)
    {
        switch ($level) {
            case 'beginner':
                return $this->getBeginnerQuestions();
            case 'intermediate':
                return $this->getIntermediateQuestions();
            case 'pro':
                return $this->getProQuestions();
        }
    }

    private function getBeginnerQuestions()
    {
        return [
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
    }

    private function getIntermediateQuestions()
    {
        return [
            ['question' => 'Which part of e-waste is most hazardous to human health?', 'options' => ['Plastic casing', 'Batteries containing lead or cadmium', 'Metal screws', 'Rubber seals'], 'correct' => 'Batteries containing lead or cadmium'],
            ['question' => 'How does improper e-waste disposal contribute to pollution?', 'options' => ['It cleans rivers and lakes', 'It releases harmful chemicals like mercury and lead into the environment', 'It improves air quality', 'It has no measurable effect'], 'correct' => 'It releases harmful chemicals like mercury and lead into the environment'],
            ['question' => 'How long can hazardous materials from e-waste remain in the environment?', 'options' => ['A few months', 'Several decades', 'A few years', 'They degrade instantly'], 'correct' => 'Several decades'],
            ['question' => 'What percentage of e-waste is recycled in Sri Lanka?', 'options' => ['5%', '15%', '25%', '35%'], 'correct' => '5%'],
            ['question' => 'Which of the following actions can help reduce e-waste?', 'options' => ['Regularly upgrading electronics', 'Repairing and reusing old devices', 'Throwing old electronics in the trash', 'Ignoring the issue'], 'correct' => 'Repairing and reusing old devices'],
            ['question' => 'What is a key factor in promoting e-waste recycling at home?', 'options' => ['Buying more electronics', 'Educating family on recycling', 'Throwing away old items', 'Hoarding electronics'], 'correct' => 'Educating family on recycling'],
            ['question' => 'Which hazard is not commonly associated with e-waste?', 'options' => ['Radioactive exposure', 'Lead poisoning', 'Mercury contamination', 'Cadmium exposure'], 'correct' => 'Radioactive exposure'],
            ['question' => 'Which electronic component is often recycled for its gold content?', 'options' => ['Plastic casings', 'PCBs in electronics', 'Mobile phone bodies', 'Rubber fittings'], 'correct' => 'PCBs in electronics'],
            ['question' => 'How can governments encourage the reduction of e-waste?', 'options' => ['By ignoring manufacturers', 'By implementing landfill taxes', 'By providing incentives for recycling', 'By banning electronics'], 'correct' => 'By providing incentives for recycling'],
            ['question' => 'Why is it challenging to recycle certain e-waste components?', 'options' => ['Their complex structure and material mix', 'Because of the color of plastics', 'Due to easily accessible recycling technologies', 'They often contain gold'], 'correct' => 'Their complex structure and material mix'],

        ];
    }

    private function getProQuestions()
    {
        return [
            ['question' => 'How can implementing a circular economy help reduce global e-waste?', 'options' => ['By promoting constant production of new electronics', 'By encouraging reuse, repair, and recycling of products to extend their lifecycle', 'By exporting all e-waste to other countries', 'By stopping the use of electronics altogether'], 'correct' => 'By encouraging reuse, repair, and recycling of products to extend their lifecycle'],
            ['question' => 'What is the role of Extended Producer Responsibility (EPR) in e-waste management?', 'options' => ['It holds consumers accountable for managing e-waste', 'It requires manufacturers to take responsibility for the disposal of their products', 'It encourages companies to produce more electronics', 'It only applies to recycled paper products'], 'correct' => 'It requires manufacturers to take responsibility for the disposal of their products'],
            ['question' => 'What international agreement regulates the transboundary movement of hazardous wastes, including e-waste?', 'options' => ['Kyoto Protocol', 'Basel Convention', 'Paris Agreement', 'Montreal Protocol'], 'correct' => 'Basel Convention'],
            ['question' => 'Which technology innovation is expected to play a significant role in reducing e-waste?', 'options' => ['5G networks', 'Modular electronics that are easily upgradeable', 'Cryptocurrency mining', 'Autonomous vehicles'], 'correct' => 'Modular electronics that are easily upgradeable'],
            ['question' => 'What is the primary reason developing countries struggle with managing imported e-waste?', 'options' => ['Lack of infrastructure and regulations', 'Abundance of recycling centers', 'Too much funding for e-waste disposal', 'Surplus of technology education'], 'correct' => 'Lack of infrastructure and regulations'],
            ['question' => 'How does urban mining relate to e-waste recycling?', 'options' => ['It involves traditional mining methods', 'Extracting valuable metals from waste', 'Building new electronics from old ones', 'Creating landfills in urban areas'], 'correct' => 'Extracting valuable metals from waste'],
            ['question' => 'What is one benefit of repairing and upgrading electronics?', 'options' => ['Increasing waste in landfills', 'Prolongs the life of the device and reduces e-waste', 'Makes devices less efficient', 'Complicates recycling processes'], 'correct' => 'Prolongs the life of the device and reduces e-waste'],
            ['question' => 'Why is e-waste legislation important?', 'options' => ['Encourages irresponsible disposal', 'Helps standardize recycling practices and protect the environment', 'Increases landfill space', 'Lowers recycling costs'], 'correct' => 'Helps standardize recycling practices and protect the environment'],
            ['question' => 'How does the consumer’s behavior influence e-waste generation?', 'options' => ['By using electronic devices less', 'Through frequent upgrading and discarding devices', 'By never discarding devices', 'By only upgrading straps'], 'correct' => 'Through frequent upgrading and discarding devices'],
            ['question' => 'What can individuals do to support e-waste management?', 'options' => ['Avoid recycling', 'Purchase sustainable products and recycle responsibly', 'Hoard electronics at home', 'Throw old devices in the trash'], 'correct' => 'Purchase sustainable products and recycle responsibly'],

        ];
    }
}
