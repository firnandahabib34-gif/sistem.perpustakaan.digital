<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id', 'user_id', 'loan_date', 'due_date', 'return_date', 'status', 'fine'
    ];

    protected $casts = [
        'loan_date' => 'date',
        'due_date' => 'date',
        'return_date' => 'date',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function calculateFine()
    {
        if ($this->return_date && $this->return_date > $this->due_date) {
            $daysLate = $this->return_date->diffInDays($this->due_date);
            return $daysLate * 1000;
        }
        return 0;
    }

    public function updateStatus()
    {
        if ($this->return_date) {
            $this->status = 'returned';
        } elseif (now() > $this->due_date) {
            $this->status = 'late';
        } else {
            $this->status = 'borrowed';
        }
        $this->save();
    }
}