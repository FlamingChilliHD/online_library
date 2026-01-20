<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Loan;

class UpdateLoanFines extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-loan-fines';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $base_fine = 0.75; // 75p fine per day

        $overdue_loans = Loan::where('due_date', '<', now())
        ->whereNull('returned_at')
        ->get();

        foreach ($overdue_loans as $loan) {
            $days_overdue = now()->diffInDays($loan->due_date);

            $loan->fine_amount = $days_overdue * $base_fine;
            $loan->save();
        }
    }
}
