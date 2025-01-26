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
                'question' => 'What is e-waste?',
                'option_a' => 'Plastic waste',
                'option_b' => 'Electronic waste',
                'option_c' => 'Organic waste',
                'option_d' => 'None of the above',
                'correct_option' => 'B',
            ],
            [
                'question' => 'Which of the following is an example of e-waste?',
                'option_a' => 'Old computers',
                'option_b' => 'Newspapers',
                'option_c' => 'Plastic bottles',
                'option_d' => 'Food scraps',
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
