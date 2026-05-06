<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    /**
     * Menampilkan halaman riwayat dan status peminjaman
     */
    public function index()
    {
        $user = Auth::user();

        // Jika yang login Admin: Tampilkan SEMUA riwayat peminjaman siswa
        if ($user->role === 'admin') {
            $borrowings = Borrowing::with(['user', 'book'])->latest()->get();
        } 
        // Jika yang login User biasa: Tampilkan HANYA riwayat miliknya sendiri
        else {
            $borrowings = Borrowing::with('book')->where('user_id', $user->id)->latest()->get();
        }

        return view('borrowings.index', compact('borrowings'));
    }

    /**
     * Logika ketika tombol "Pinjam Buku" diklik
     */
    public function store(Request $request, Book $book)
    {
        // 1. Validasi: Pastikan ini adalah buku fisik
        if ($book->type !== 'physical') {
            return back()->with('error', 'Buku digital tidak perlu dipinjam fisik, Anda bisa langsung membacanya.');
        }

        // 2. Validasi: Pastikan stok masih ada
        if ($book->stock < 1) {
            return back()->with('error', 'Maaf, stok buku ini sedang habis dipinjam siswa lain.');
        }

        // 3. Validasi: Cegah user meminjam buku yang sama berulang kali jika belum dikembalikan
        $hasActiveBorrowing = Borrowing::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->whereNull('returned_at')
            ->exists();

        if ($hasActiveBorrowing) {
            return back()->with('error', 'Anda masih meminjam buku ini dan belum mengembalikannya.');
        }

        // 4. Berhasil lolos validasi -> Kurangi stok fisik buku (Minus 1)
        $book->decrement('stock');

        // 5. Catat ke database transaksi (Tenggat waktu: 7 hari dari sekarang)
        Borrowing::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'borrow_date' => now(),
            'due_date' => now()->addDays(7),
            'status' => 'borrowed'
        ]);

        return back()->with('success', 'Buku berhasil dipinjam! Silakan ambil fisik bukunya di meja pustakawan.');
    }

    /**
     * Logika ketika buku dikembalikan
     */
    public function returnBook(Borrowing $borrowing)
    {
        // Cegah error jika tombol kembalikan diklik berkali-kali
        if ($borrowing->returned_at) {
            return back()->with('error', 'Buku ini sudah tercatat dikembalikan sebelumnya.');
        }

        // 1. Ubah status transaksi menjadi dikembalikan (returned) beserta tanggal riilnya
        $borrowing->update([
            'returned_at' => now(),
            'status' => 'returned'
        ]);

        // 2. Tambahkan kembali stok buku (Plus 1) agar bisa dipinjam orang lain
        $borrowing->book->increment('stock');

        return back()->with('success', 'Buku telah berhasil dikembalikan ke perpustakaan. Terima kasih!');
    }
}