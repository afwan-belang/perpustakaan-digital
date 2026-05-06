<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    // Mengizinkan semua kolom diisi secara massal (termasuk type, genre, stock, path_pdf)
    protected $guarded = [];

    // ---------------------------------------------------
    // RELASI BAWAAN ANDA
    // ---------------------------------------------------
    
    // Satu buku milik satu kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites', 'book_id', 'user_id')->withTimestamps();
    }
}