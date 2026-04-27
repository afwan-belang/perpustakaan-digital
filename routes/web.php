<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;


Route::get('/', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('home');

Route::middleware(['auth', 'admin'])->group(function () {
    
    Route::get('/tambah-buku', [BookController::class, 'create'])->name('books.create');
    Route::post('/simpan-buku', [BookController::class, 'store'])->name('books.store');
    
    Route::get('/buku/{id}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/buku/{id}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/buku/{id}', [BookController::class, 'destroy'])->name('books.destroy');
    
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';