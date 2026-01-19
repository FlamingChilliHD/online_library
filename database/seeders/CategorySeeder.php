<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryData = [
            [
                'name' => 'Fantasy',
            ],

            [
                'name' => 'Mystery',
            ],

            [
                'name' => 'Sci-Fi',
            ],

            [
                'name' => 'Horror',
            ],

            [
                'name' => 'Dystopian',
            ],
        ];

        Category::insert($categoryData);
    }
}
