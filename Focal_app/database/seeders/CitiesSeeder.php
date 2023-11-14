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
            ['name' => 'Aleppo '],
            ['name' => ' Latakia'],
            ['name' => ' Homs'],
            ['name' => ' Hama'],
            ['name' => ' Tartus'],
            ['name' => ' Damascus'],
            ['name' => ' Rif Dimashq'],
            ['name' => ' Deir ez-Zor'],
            ['name' => ' Raqqa'],
            ['name' => ' Hasakah'],
            ['name' => ' Daraa'],
            ['name' => ' Quneitra'],
            ['name' => ' Al-Suwayda'],
            ['name' => ' Idlib'],
            ['name' => 'Other'],

        ];

        City::insert($cities);
    }
}
