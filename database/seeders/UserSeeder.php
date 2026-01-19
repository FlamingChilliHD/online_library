<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'Visitor',
                'email' => 'Visitor@mail.com',
                'password' => Hash::make('1234567890'),
                'is_librarian' => false,
            ],

            [
                'name' => 'Old Visitor',
                'email' => 'Oldvisitor@mail.com',
                'password' => Hash::make('1234567890'),
                'is_librarian' => false,
            ],

            [
                'name' => 'New Visitor',
                'email' => 'Newvisitor@mail.com',
                'password' => Hash::make('1234567890'),
                'is_librarian' => false,
            ],

            [
                'name' => 'Random Visitor',
                'email' => 'Randomvisitor@mail.com',
                'password' => Hash::make('1234567890'),
                'is_librarian' => false,
            ],

            [
                'name' => 'Librarian',
                'email' => 'Librarian@mail.com',
                'password' => Hash::make('1234567890'),
                'is_librarian' => true,
            ],
        ];

        User::insert($userData);
    }
}
