<?php

namespace Database\Seeders;

use App\Models\CollectionPoint;
use Illuminate\Database\Seeder;

class CollectionPointsSeeder extends Seeder
{
    public function run()
    {
        $collectionPoints = [
            [
                'name' => 'Ceylon Waste Management Pvt Ltd',
                'address' => '65C, 8th Mile Post, Welivita',
                'latitude' => '6.934897', // Approximate latitude
                'longitude' => '79.884998', // Approximate longitude
                'contact_info' => 'Mobile: 077 5501845, Office: 0114 504687, Email: info@ceylonwaste.com',
            ],
            [
                'name' => 'Cleantech (Pvt) Ltd',
                'address' => 'No. 809/5, Negombo road, Mabola, Wattala',
                'latitude' => '7.013500', // Approximate latitude
                'longitude' => '79.891400', // Approximate longitude
                'contact_info' => 'Mobile: 071 9623597, Email: kasun.thennakoon@cleantech.lk',
            ],
            [
                'name' => 'Eco - Biz World (Pvt) Ltd',
                'address' => '621/3, Wekanda Road, Walgama, Malwana',
                'latitude' => '6.927079',
                'longitude' => '80.861244',
                'contact_info' => 'Mobile: 077 9129100, Email: ebw@ecobizworld.com',
            ],
            [
                'name' => 'Infinity Green International (Pvt) Ltd',
                'address' => 'No. 368, New Hunupitiya Road, Dalugama, Kelaniya',
                'latitude' => '6.974670',
                'longitude' => '79.960258',
                'contact_info' => 'Mobile: 077 3433183, Email: sanka@infinityzone.lk',
            ],
            [
                'name' => 'Inova Environmental Services (Pvt) Ltd',
                'address' => 'Galaboda Road, Wewalpanawa, Padukka',
                'latitude' => '6.843700',
                'longitude' => '80.042950',
                'contact_info' => 'Mobile: 077 3815989, Email: ayal.piyathilaka@inovaen.com',
            ],
        ];

        foreach ($collectionPoints as $point) {
            CollectionPoint::create($point);
        }
    }
}

