<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    protected $guarded = [];

    protected $casts = [
        'borrow_date' => 'date',
        'due_date' => 'date',
        'returned_at' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Ubah relasi dari book() menjadi libraryBook()
    public function libraryBook()
    {
        return $this->belongsTo(LibraryBook::class);
    }
}