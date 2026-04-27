<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookController extends Controller
{
    // 1. Menampilkan Form Upload
    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    // 2. Menyimpan Data ke Database & Storage
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'author' => 'required',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg|max:10240', // Maks 2MB
            'file_pdf' => 'required|mimes:pdf|max:150000', // Maks 10MB
        ]);

        // Proses Upload Gambar Cover
        // File akan disimpan di: storage/app/public/covers
        $coverPath = $request->file('cover_image')->store('covers', 'public');

        // Proses Upload File PDF
        // File akan disimpan di: storage/app/public/books
        $pdfPath = $request->file('file_pdf')->store('books', 'public');

        // Simpan ke Database
        Book::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'author' => $request->author,
            'description' => $request->description,
            'cover_image' => $coverPath, // Kita simpan path-nya
            'file_pdf' => $pdfPath,      // Kita simpan path-nya
        ]);

        return redirect()->route('home')->with('success', 'Buku berhasil ditambahkan!');
    }
    // 3. Menampilkan Form Edit (Ambil data lama)
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    // 4. Proses Update Data
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        // Validasi (File tidak wajib diisi saat edit, gunakan 'nullable')
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'author' => 'required',
            'cover_image' => 'nullable|image|max:10240',
            'file_pdf' => 'nullable|mimes:pdf|max:150000',
        ]);

        // Logic Update Cover (Jika user upload cover baru)
        if ($request->hasFile('cover_image')) {
            // Hapus file lama
            Storage::disk('public')->delete($book->cover_image);
            // Simpan file baru
            $pathCover = $request->file('cover_image')->store('covers', 'public');
            // Update database
            $book->update(['cover_image' => $pathCover]);
        }

        // Logic Update PDF (Jika user upload PDF baru)
        if ($request->hasFile('file_pdf')) {
            Storage::disk('public')->delete($book->file_pdf);
            $pathPdf = $request->file('file_pdf')->store('books', 'public');
            $book->update(['file_pdf' => $pathPdf]);
        }

        // Update data teks
        $book->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'author' => $request->author,
            'description' => $request->description,
        ]);

        return redirect()->route('home')->with('success', 'Buku berhasil diperbarui!');
    }

    // 5. Proses Hapus Data
    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        // Hapus File Fisik dulu agar bersih
        Storage::disk('public')->delete($book->cover_image);
        Storage::disk('public')->delete($book->file_pdf);

        // Hapus Record di Database
        $book->delete();

        return redirect()->route('home')->with('success', 'Buku berhasil dihapus!');
    }
}