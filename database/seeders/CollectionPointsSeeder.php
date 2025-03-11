<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CollectionPoint;

class CollectionPointsSeeder extends Seeder
{
    public function run()
    {
        $collectionPoints = [
            [
                'name' => 'E-Sampath Piyasa',
                'address' => 'VVP8+3RJ, Colombo - Ratnapura - Wellawaya - Batticaloa Rd, Colombo 00500',
                'latitude' => '6.885213',
                'longitude' => '79.867027',
                'contact_info' => null,
            ],
            [
                'name' => 'Cleantech Sampath Piyasa',
                'address' => 'Sri Jayawardenepura Kotte',
                'latitude' => '6.908736',
                'longitude' => '79.894834',
                'contact_info' => null,
            ],
            [
                'name' => 'Waste Management Authority - Diga Salu',
                'address' => 'WW2H+P23, Hector Kobbekaduwa Mw, Colombo 00700',
                'latitude' => '6.901795',
                'longitude' => '79.927600',
                'contact_info' => null,
            ],
            [
                'name' => 'Cleantech Circular Economy Services',
                'address' => '809/4 Bangalawatte Road, Wattala',
                'latitude' => '7.004773',
                'longitude' => '79.894924',
                'contact_info' => null,
            ],
            [
                'name' => 'Cleantech (Pvt) Ltd',
                'address' => '141 Bernard Soysa Mawatha, Colombo 00500',
                'latitude' => '6.893257',
                'longitude' => '79.873305',
                'contact_info' => null,
            ],
            [
                'name' => 'Cleantech E - Sampath Piyasa Maligakanda',
                'address' => 'White Park, Colombo 01000',
                'latitude' => '6.926263',
                'longitude' => '79.871755',
                'contact_info' => null,
            ],
        ];

        // Insert or update data without duplicates
        foreach ($collectionPoints as $point) {
            CollectionPoint::updateOrInsert(
                ['name' => $point['name']], // Search by 'name'
                $point // If exists, update; if not, insert
            );
        }
    }
}
