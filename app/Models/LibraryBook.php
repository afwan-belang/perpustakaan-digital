<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LibraryBook extends Model
{
    protected $guarded = [];

    // Relasi: Satu buku fisik bisa memiliki banyak riwayat peminjaman
    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
}