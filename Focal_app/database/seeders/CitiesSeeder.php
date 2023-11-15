<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            ['city_name' => 'Aleppo '],
            ['city_name' => ' Latakia'],
            ['city_name' => ' Homs'],
            ['city_name' => ' Hama'],
            ['city_name' => ' Tartus'],
            ['city_name' => ' Damascus'],
            ['city_name' => ' Rif Dimashq'],
            ['city_name' => ' Deir ez-Zor'],
            ['city_name' => ' Raqqa'],
            ['city_name' => ' Hasakah'],
            ['city_name' => ' Daraa'],
            ['city_name' => ' Quneitra'],
            ['city_name' => ' Al-Suwayda'],
            ['city_name' => ' Idlib'],
            ['city_name' => 'Other'],

        ];

        City::insert($cities);
    }
}
