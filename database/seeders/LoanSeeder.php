<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Loan;
use Carbon\CarbonImmutable;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $current_day = CarbonImmutable::today();
        $due_date = $current_day->addDays(31);

        $loanData = [
            [
                'user_id' => 1,
                'book_id' => 1,
                'borrowed_at' => '2025-12-05',
                'due_date' => '2026-01-05',
            ],

            [
                'user_id' => 2,
                'book_id' => 2,
                'borrowed_at' => $current_day,
                'due_date' => $due_date,
            ],

            [
                'user_id' => 3,
                'book_id' => 3,
                'borrowed_at' => $current_day,
                'due_date' => $due_date,
            ],

            [
                'user_id' => 4,
                'book_id' => 4,
                'borrowed_at' => $current_day,
                'due_date' => $due_date,
            ],

            [
                'user_id' => 5,
                'book_id' => 5,
                'borrowed_at' => $current_day,
                'due_date' => $due_date,
            ],
        ];

        Loan::insert($loanData);
    }
}
