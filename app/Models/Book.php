<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded = [];

    // Satu buku milik satu kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}