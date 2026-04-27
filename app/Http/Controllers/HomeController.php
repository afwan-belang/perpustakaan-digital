<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil Kategori (untuk menu)
        $categories = Category::all();

        // 2. Siapkan Query Buku
        $books = Book::query();

        // 3. Cek apakah ada filter kategori di URL? (contoh: ?category_id=1)
        if ($request->has('category_id')) {
            $books->where('category_id', $request->category_id);
        }

        // 4. Eksekusi query (get data)
        $dataBooks = $books->latest()->get();

        // 5. Kirim ke View
        return view('welcome', compact('categories', 'dataBooks'));
    }
}