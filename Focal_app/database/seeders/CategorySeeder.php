<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['title' => 'Artificial intelligence '],
            ['title' => ' programming'],
            ['title' => ' Design'],
            ['title' => ' Mobile applications'],
            ['title' => ' Sites Design'],
            ['title' => ' Marketing'],

        ];

        Category::insert($categories);
    }
}
