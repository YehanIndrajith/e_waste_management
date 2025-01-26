<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ImageMatching;

class ImageMatchingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['image' => 'old-mobile.jpg', 'category' => 'Recycle'],
            ['image' => 'aa-battery.jpeg', 'category' => 'Hazardous'],
            ['image' => 'laptop-charger.jpeg', 'category' => 'Re-use'],

            ['image' => 'headphones.jpeg', 'category' => 'Re-use'],
            ['image' => 'broken-remote-control.webp', 'category' => 'Recycle'],
            ['image' => 'led-light-bulb.jpeg', 'category' => 'Hazardous'],

            ['image' => 'crt-monitor.jpeg', 'category' => 'Hazardous'],
            ['image' => 'fluorescent-light-bulb.jpeg', 'category' => 'Hazardous'],
            ['image' => 'tablet.jpeg', 'category' => 'Recycle'],

            ['image' => 'lithium-ion-battery.jpg', 'category' => 'Hazardous'],
            ['image' => 'metal-computer-case.jpeg', 'category' => 'Re-use'],
            ['image' => 'plastic-keyboard.jpeg', 'category' => 'Recycle'],

            ['image' => 'smartphone-battery.jpeg', 'category' => 'Hazardous'],
            ['image' => 'smartphone-screen.jpeg', 'category' => 'Recycle'],
            ['image' => 'solar-panel.jpeg', 'category' => 'Recycle'],
            ['image' => 'computer-monitor.jpeg', 'category' => 'Hazardous'],

            ['image' => 'lead-acid-battery.jpeg', 'category' => 'Hazardous'],
            ['image' => 'hard-drive.jpeg', 'category' => 'Re-use'],
            ['image' => 'broken-microwave-oven.jpg', 'category' => 'Recycle'],

            ['image' => 'recycle-bin.jpeg', 'category' => 'Recycle'],
            ['image' => 'recycling-clipart.jpeg', 'category' => 'Re-use'],
            ['image' => 'hazardous.jpeg', 'category' => 'Hazardous'],
        ];

        foreach ($items as $item) {
            ImageMatching::create($item);
        }
    }
}
