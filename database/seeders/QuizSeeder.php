<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Quiz;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            $questions = [
                ['What does "e-waste" stand for?', 'Environmental waste', 'Electronic waste', 'Energy waste', 'Excess waste', 'B'],
                ['Which of the following is considered e-waste?', 'Plastic bottles', 'Old smartphones', 'Cardboard boxes', 'Food waste', 'B'],
                ['What is the environmental impact of improperly disposing of e-waste?', 'It reduces pollution', 'It contaminates soil and water', 'It improves soil quality', 'It has no effect', 'B'],
                ['Which hazardous material is often found in e-waste?', 'Aluminum', 'Lead', 'Wood', 'Plastic', 'B'],
                ['What should you do with old electronics you no longer use?', 'Throw them in the trash', 'Donate, recycle, or sell them', 'Store them at home forever', 'Burn them', 'B'],
                ['Which of the following is a safe way to dispose of e-waste?', 'Landfilling', 'Recycling at a certified facility', 'Throwing in a river', 'Burning in an open field', 'B'],
                ['Why is public awareness of e-waste important?', 'It encourages more e-waste generation', 'It helps communities manage waste safely and responsibly', 'It makes technology more expensive', 'It reduces job opportunities', 'B'],
                ['What percentage of global e-waste is currently recycled?', '10%', '50%', '20%', '80%', 'C'],
                ['How does improper e-waste disposal affect human health?', 'It improves immune systems', 'It releases harmful chemicals that can cause serious health issues', 'It has no effect on health', 'It provides nutrients for better growth', 'B'],
                ['What is the purpose of e-waste recycling?', 'To reduce energy consumption', 'To reuse valuable materials and reduce environmental harm', 'To increase electronic sales', 'To produce more landfill space', 'B'],
            ];
        
            foreach ($questions as $question) {
                Quiz::create([
                    'question' => $question[0],
                    'option_a' => $question[1],
                    'option_b' => $question[2],
                    'option_c' => $question[3],
                    'option_d' => $question[4],
                    'correct_option' => $question[5],
                ]);
            }
        }
    }
}
