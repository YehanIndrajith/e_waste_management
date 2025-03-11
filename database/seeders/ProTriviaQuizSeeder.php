<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProTriviaQuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pro_trivia_quizzes')->insert([
            [
                'question' => 'What international agreement regulates the transboundary movement of hazardous wastes, including e-waste?',
                'option_a' => 'Kyoto Protocol',
                'option_b' => 'Basel Convention',
                'option_c' => 'Paris Agreement',
                'option_d' => 'Montreal Protocol',
                'correct_answer' => 'Basel Convention',
            ],
            [
                'question' => 'Which country is currently the largest producer of e-waste in Sri Lanka?',
                'option_a' => 'Western Province',
                'option_b' => 'Southern Province',
                'option_c' => 'Central Province',
                'option_d' => 'Eastern Province',
                'correct_answer' => 'Western Province',
            ],
            [
                'question' => 'What is the primary reason developing countries struggle with managing imported e-waste?',
                'option_a' => 'Lack of infrastructure and regulations',
                'option_b' => 'Abundance of recycling centers',
                'option_c' => 'Too much funding for e-waste disposal',
                'option_d' => 'Surplus of technology education',
                'correct_answer' => 'Lack of infrastructure and regulations',
            ],
            [
                'question' => 'How can the concept of a "circular economy" help solve the e-waste problem?',
                'option_a' => 'By encouraging faster consumption of electronics',
                'option_b' => 'By promoting reuse, repair, and recycling of products',
                'option_c' => 'By reducing electronic production entirely',
                'option_d' => 'By focusing on exporting e-waste to other countries',
                'correct_answer' => 'By promoting reuse, repair, and recycling of products',
            ],
            [
                'question' => 'Which technology innovation is expected to play a significant role in reducing e-waste?',
                'option_a' => '5G networks',
                'option_b' => 'Modular electronics that are easily upgradeable',
                'option_c' => 'Cryptocurrency mining',
                'option_d' => 'Autonomous vehicles',
                'correct_answer' => 'Modular electronics that are easily upgradeable',
            ],
        ]);

    }
}
