<?php

namespace App\Http\Controllers;

use App\Models\LibraryBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LibraryBookController extends Controller
{
    /**
     * Menampilkan daftar semua buku fisik di perpustakaan
     */
    public function index()
    {
        $books = LibraryBook::latest()->get();
        return view('library.index', compact('books'));
    }

    /**
     * Menampilkan form tambah buku fisik
     */
    public function create()
    {
        return view('library.create');
    }

    /**
     * Menyimpan data buku fisik baru ke database
     */
    /**
     * Menyimpan data buku fisik baru ke database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'published_year' => 'required|integer|digits:4',
            'pages' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'genre' => 'nullable|string|max:255',
            'stock' => 'required|integer|min:0',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Jika ada file gambar cover yang diunggah
        if ($request->hasFile('cover')) {
            // 1. Simpan gambar ke folder storage/app/public/covers
            $validated['path_cover'] = $request->file('cover')->store('covers', 'public');
            
            // 2. Hapus key 'cover' dari array agar tidak ikut tersimpan ke database
            unset($validated['cover']);
        }

        LibraryBook::create($validated);

        return redirect()->route('library.index')->with('success', 'Buku fisik berhasil ditambahkan ke pendataan perpustakaan.');
    }
    /**
     * Menghapus buku fisik dari database
     */
    public function destroy(LibraryBook $library)
    {
        // Hapus file cover jika ada
        if ($library->path_cover) {
            Storage::disk('public')->delete($library->path_cover);
        }
        $library->delete();

        return redirect()->route('library.index')->with('success', 'Data buku fisik berhasil dihapus.');
    }
}