<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Loan extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'due_date',
        'fine_amount',
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
        'returned_at' => 'date',
    ];
}
