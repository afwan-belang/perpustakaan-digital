<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use Illuminate\Http\Request;

class AdminBorrowingController extends Controller
{
    /**
     * Menampilkan semua antrean & riwayat peminjaman (Khusus Admin)
     */
    public function index()
    {
        // Mengambil data peminjaman beserta relasi user dan bukunya, diurutkan dari yang terbaru
        $borrowings = Borrowing::with(['user', 'libraryBook'])->latest()->get();
        return view('admin-borrowings.index', compact('borrowings'));
    }

    /**
     * Logika ketika Admin menerima pengajuan (ACC)
     */
    public function approve(Borrowing $borrowing)
    {
        if ($borrowing->status !== 'pending') {
            return back()->with('error', 'Status peminjaman tidak valid untuk disetujui.');
        }

        // Cek lagi apakah stok masih ada (untuk mencegah bug jika di-ACC bersamaan)
        if ($borrowing->libraryBook->stock < 1) {
            return back()->with('error', 'Gagal menyetujui! Stok buku fisik sedang kosong.');
        }

        // 1. Kurangi stok buku fisik
        $borrowing->libraryBook->decrement('stock');

        // 2. Ubah status menjadi 'approved' dan set tanggal peminjaman & tenggat waktu (misal 7 hari)
        $borrowing->update([
            'status' => 'approved',
            'borrow_date' => now(),
            'due_date' => now()->addDays(7),
        ]);

        return back()->with('success', 'Peminjaman disetujui! Stok buku otomatis dikurangi.');
    }

    /**
     * Logika ketika Admin menolak pengajuan
     */
    public function reject(Borrowing $borrowing)
    {
        if ($borrowing->status !== 'pending') {
            return back()->with('error', 'Status peminjaman tidak valid.');
        }

        // Tolak tanpa mengubah stok
        $borrowing->update(['status' => 'rejected']);

        return back()->with('success', 'Pengajuan peminjaman telah ditolak.');
    }

    /**
     * Logika ketika Siswa mengembalikan buku fisik
     */
    public function returnBook(Borrowing $borrowing)
    {
        if ($borrowing->status !== 'approved') {
            return back()->with('error', 'Buku ini belum dalam status dipinjam.');
        }

        // 1. Tambahkan kembali stok buku fisik
        $borrowing->libraryBook->increment('stock');

        // 2. Ubah status menjadi 'returned' dan catat waktu riil pengembalian
        $borrowing->update([
            'status' => 'returned',
            'returned_at' => now(),
        ]);

        return back()->with('success', 'Buku berhasil dikembalikan! Stok buku telah ditambah kembali.');
    }
}