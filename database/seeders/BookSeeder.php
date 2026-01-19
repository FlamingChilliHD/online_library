<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookData = [
            [
                'title' => 'The Hobbit',
                'author' => 'J.R.R. Tolkien',
                'ISBN' => '9780547928227',
                'stock' => 10,
                'category_id' => 1, // Fantasy
            ],

            [
                'title' => 'The Girl with the Dragon Tattoo',
                'author' => 'Stieg Larsson',
                'ISBN' => '9780307454599',
                'stock' => 15,
                'category_id' => 2, // Mystery
            ],

            [
                'title' => 'Dune',
                'author' => 'Frank Herbert',
                'ISBN' => '9780441172719',
                'stock' => 12,
                'category_id' => 3, // Sci-Fi
            ],

            [
                'title' => 'The Haunting of Hill House',
                'author' => 'Shirley Jackson',
                'ISBN' => '9780143039986',
                'stock' => 18,
                'category_id' => 4, // Horror
            ],

            [
                'title' => 'The Hunger Games',
                'author' => 'Suzanne Collins',
                'ISBN' => '9780439023528',
                'stock' => 20,
                'category_id' => 5, // Dystopian
            ],
        ];

        Book::insert($bookData);
    }


}
