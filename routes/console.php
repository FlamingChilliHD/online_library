<?php

use Illuminate\Foundation\Inspiring;
use App\Models\Loan;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Jobs\CalculateOverdueFines;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function (){
    // 1. Find all loans that are NOT returned
    $current_loans = Loan::whereNull('returned_at')->get();

    // 2. Dispatch a job for each one to check for fines
    foreach ($current_loans as $loan) {
        CalculateOverdueFines::dispatch($loan);
    }
})->everyMinute();
