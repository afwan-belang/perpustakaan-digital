<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil Kategori (untuk menu pills)
        $categories = Category::all();

        // 2. Siapkan Query Buku dasar
        $books = Book::query();

        // 3. Filter berdasarkan Kategori (jika ada)
        if ($request->has('category_id') && $request->category_id != '') {
            $books->where('category_id', $request->category_id);
        }

        // 4. Filter berdasarkan Pencarian (Search)
        if ($request->has('search') && $request->search != '') {
            $books->where(function($query) use ($request) {
                // Mencari berdasarkan judul ATAU nama penulis
                $query->where('title', 'like', '%' . $request->search . '%')
                      ->orWhere('author', 'like', '%' . $request->search . '%');
            });
        }

        // 5. Eksekusi query (ambil data terbaru)
        $dataBooks = $books->latest()->paginate(10)->withQueryString();

        // 6. Kirim ke View (Arahkan ke folder pages seperti yang sudah kita perbaiki)
        return view('pages.welcome', compact('categories', 'dataBooks'));
    }
}