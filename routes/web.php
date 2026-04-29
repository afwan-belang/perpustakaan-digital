<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\FavoriteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// 1. Rute Landing Page (Bisa diakses siapa saja / Guest)
Route::get('/', function () {
    return view('pages.landing');
})->name('landing');

// 2. Rute Halaman Utama Perpustakaan (Hanya bisa diakses setelah Login)
Route::get('/pustaka', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('home');

// 3. Rute yang Membutuhkan Login (Hanya User Biasa & Admin)
Route::middleware('auth')->group(function () {
    
    // Rute Profil Bawaan Laravel
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute Fitur Buku Favorit (Hanya untuk User)
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorites/{book}/toggle', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
});

// 4. Rute Gembok Ganda (KHUSUS ADMIN)
Route::middleware(['auth', 'admin'])->group(function () {
    
    // Rute Manajemen Buku (Create, Store, Edit, Update, Destroy)
    // Rute ini sekarang sepenuhnya aman dari user biasa
    Route::resource('books', BookController::class)->except(['index', 'show']);
    
});

// Memuat rute Autentikasi bawaan Laravel Breeze (Login, Register, Logout)
require __DIR__.'/auth.php';