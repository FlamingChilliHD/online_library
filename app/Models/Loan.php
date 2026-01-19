<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\CarbonImmutable;

class Loan extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'due_date',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function book(): BelongsTo {
        return $this->belongsTo(Book::class);
    }

    protected $casts = [
        'due_date' => 'date',
        'borrowed_at' => 'date',
    ];

    public function calculateOverdueFine(): float
    {
        $due = CarbonImmutable::parse($this->due_date);
        $today = CarbonImmutable::today();

        $day_difference = $today->diffInDays($due, false);

        // Not overdue
        if ($day_difference >= 0) {
            return 0;
        }

        $days_overdue = abs($day_difference);
        $base_fine = 0.75;

        return $days_overdue * $base_fine;
    }

    public function applyOverdueFine(): void
    {
        $this->fine_amount = $this->calculateOverdueFine();
        $this->save();
    }
}
