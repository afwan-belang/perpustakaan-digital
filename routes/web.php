<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\FavoriteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\LibraryBookController;
use App\Http\Controllers\UserLibraryController;
use App\Http\Controllers\AdminBorrowingController;

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

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('books', BookController::class)->except(['index', 'show']);
    Route::resource('library', LibraryBookController::class)->except(['show', 'edit', 'update']);
    
    Route::get('/admin/sirkulasi', [AdminBorrowingController::class, 'index'])->name('admin.borrowings.index');
    Route::post('/admin/sirkulasi/{borrowing}/approve', [AdminBorrowingController::class, 'approve'])->name('admin.borrowings.approve');
    Route::post('/admin/sirkulasi/{borrowing}/reject', [AdminBorrowingController::class, 'reject'])->name('admin.borrowings.reject');
    Route::post('/admin/sirkulasi/{borrowing}/return', [AdminBorrowingController::class, 'returnBook'])->name('admin.borrowings.return');
});

    // 3. Rute yang Membutuhkan Login (Hanya User Biasa & Admin)
Route::middleware('auth')->group(function () {
    
    // Rute Profil Bawaan
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute Fitur Buku Favorit
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorites/{book}/toggle', [FavoriteController::class, 'toggle'])->name('favorites.toggle');

    // Rute Membaca Buku (Tersedia untuk semua yang login)
    Route::resource('books', BookController::class)->only(['index', 'show']);

    // ==========================================
    // RUTE PEMINJAMAN BUKU (BARU)
    // ==========================================
    Route::get('/borrowings', [BorrowingController::class, 'index'])->name('borrowings.index');
    Route::post('/borrowings/{book}', [BorrowingController::class, 'store'])->name('borrowings.store');
    Route::post('/borrowings/return/{borrowing}', [BorrowingController::class, 'returnBook'])->name('borrowings.return');
    // ==========================================
    Route::get('/katalog-fisik', [UserLibraryController::class, 'index'])->name('user.library.index');
    Route::get('/katalog-fisik/{book}', [UserLibraryController::class, 'show'])->name('user.library.show');
    Route::post('/katalog-fisik/{book}/pinjam', [UserLibraryController::class, 'requestBorrow'])->name('user.library.borrow');

    // Rute Riwayat Peminjaman User
    Route::get('/riwayat-pinjaman', [UserLibraryController::class, 'history'])->name('user.library.history');
});
// 4. Rute Gembok Ganda (KHUSUS ADMIN)


// Memuat rute Autentikasi bawaan Laravel Breeze (Login, Register, Logout)
require __DIR__.'/auth.php';