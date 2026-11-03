<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Loan;
use Carbon\Carbon;

class UpdateLoanFines extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'loans:update-fines';

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

        $overdue_loans = Loan::where('due_date', '<', today())
        ->whereNull('returned_at')
        ->get();

        foreach ($overdue_loans as $loan) {
            $days_overdue = abs(today()->diffInDays($loan->due_date));

            if ($days_overdue <= 1) {
                continue;
            }

            $applied_days = $days_overdue - 1;

            $loan->update([
                'fine_amount' => $applied_days * $base_fine,
            ]);

            $this->info("Loan ID {$loan->id}: Days overdue: {$days_overdue} days | Chargeable: {$applied_days} days | Fine: £" . ($applied_days * $base_fine));
        }
    }
}
