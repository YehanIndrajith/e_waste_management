<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BeginnerQuiz;

class BeginnerQuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BeginnerQuiz::insert([
            [
                'question' => 'Which of these household items is considered e-waste?',
                'option_a' => 'Broken television',
                'option_b' => 'Used paper napkin',
                'option_c' => 'Empty soda can',
                'option_d' => 'Old book',
                'correct_option' => 'A',
            ],
            [
                'question' => 'What is the best way to handle e-waste at home?',
                'option_a' => 'Separate and take it to an e-waste collection center',
                'option_b' => 'Mix it with regular garbage',
                'option_c' => 'Ignore it until it breaks completely',
                'option_d' => 'Throw it into a river',
                'correct_option' => 'A',
            ],
            [
                'question' => 'Why is it important to manage e-waste properly?',
                'option_a' => 'It reduces landfill space',
                'option_b' => 'It minimizes pollution and health risks',
                'option_c' => 'It increases the lifespan of electronics',
                'option_d' => 'It boosts the economy',
                'correct_option' => 'B',
            ],
            [
                'question' => 'Where should you take your old electronics for proper disposal?',
                'option_a' => 'Local landfill',
                'option_b' => 'Certified recycling center',
                'option_c' => 'Backyard',
                'option_d' => 'Local grocery store',
                'correct_option' => 'B',
            ],
            [
                'question' => 'Which of these materials can be found in e-waste?',
                'option_a' => 'Cotton',
                'option_b' => 'Glass',
                'option_c' => 'Mercury',
                'option_d' => 'Wood',
                'correct_option' => 'C',
            ],
        ]);
    }
}
