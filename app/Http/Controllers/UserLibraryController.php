<?php

namespace App\Http\Controllers;

use App\Models\LibraryBook;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLibraryController extends Controller
{
    /**
     * Menampilkan katalog buku fisik perpustakaan untuk User
     */
    public function index()
    {
        // Menampilkan buku fisik terbaru
        $books = LibraryBook::latest()->get();
        return view('user-library.index', compact('books'));
    }

    /**
     * Menampilkan detail buku fisik
     */
    public function show(LibraryBook $book)
    {
        return view('user-library.show', compact('book'));
    }

    /**
     * Logika untuk mengajukan peminjaman buku fisik
     */
    public function requestBorrow(LibraryBook $book)
    {
        $user = Auth::user();

        // 1. VALIDASI STOK (Meskipun pending, stok harus ada minimal 1)
        if ($book->stock < 1) {
            return back()->with('error', 'Maaf, stok buku ini sedang kosong.');
        }

        // 2. VALIDASI LIMIT (Maksimal 3 buku yang statusnya pending atau approved)
        $activeBorrowingsCount = Borrowing::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'approved'])
            ->count();

        if ($activeBorrowingsCount >= 3) {
            return back()->with('error', 'Limit tercapai! Anda hanya diperbolehkan meminjam atau mengajukan maksimal 3 buku fisik dalam satu waktu.');
        }

        // 3. VALIDASI DUPLIKASI (Cegah user mengajukan buku yang sama dua kali)
        $alreadyRequested = Borrowing::where('user_id', $user->id)
            ->where('library_book_id', $book->id)
            ->whereIn('status', ['pending', 'approved'])
            ->exists();

        if ($alreadyRequested) {
            return back()->with('error', 'Anda sedang meminjam atau sudah mengajukan peminjaman untuk buku ini.');
        }

        // 4. LOLOS VALIDASI -> Buat pengajuan baru (Status: Pending, Stok BELUM dikurangi)
        Borrowing::create([
            'user_id' => $user->id,
            'library_book_id' => $book->id,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Pengajuan peminjaman berhasil dikirim! Silakan tunggu konfirmasi persetujuan dari Admin.');
    }
    /**
     * Menampilkan riwayat pengajuan & peminjaman buku untuk User yang sedang login
     */
    public function history()
    {
        $borrowings = Borrowing::with('libraryBook')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
            
        return view('user-library.history', compact('borrowings'));
    }
}