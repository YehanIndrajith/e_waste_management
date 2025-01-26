<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\IntermediateQuiz;

class IntermediateQuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        IntermediateQuiz::insert([
            [
                'question' => 'Which toxic metals are commonly found in e-waste?',
                'option_a' => 'Lead and mercury',
                'option_b' => 'Iron and copper',
                'option_c' => 'Silver and gold',
                'option_d' => 'Aluminum and zinc',
                'correct_option' => 'A',
            ],
            [
                'question' => 'What is the environmental impact of improperly discarded e-waste?',
                'option_a' => 'It helps soil regeneration',
                'option_b' => 'It contaminates water and soil with harmful chemicals',
                'option_c' => 'It promotes wildlife growth',
                'option_d' => 'It reduces energy usage',
                'correct_option' => 'B',
            ],
            [
                'question' => 'How long can hazardous materials from e-waste remain in the environment?',
                'option_a' => 'A few months',
                'option_b' => 'Several decades',
                'option_c' => 'A few years',
                'option_d' => 'They degrade instantly',
                'correct_option' => 'B',
            ],
            [
                'question' => 'What percentage of e-waste is recycled in Sri Lanka?',
                'option_a' => '5%',
                'option_b' => '15%',
                'option_c' => '25%',
                'option_d' => '35%',
                'correct_option' => 'A',
            ],
            [
                'question' => 'Which of the following actions can help reduce e-waste?',
                'option_a' => 'Regularly upgrading electronics',
                'option_b' => 'Repairing and reusing old devices',
                'option_c' => 'Throwing old electronics in the trash',
                'option_d' => 'Ignoring the issue',
                'correct_option' => 'B',
            ],
        ]);
    }
}
