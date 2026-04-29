<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    // Menampilkan halaman daftar buku favorit
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        // Ambil buku yang difavoritkan oleh user yang sedang login
        $dataBooks = $user->favorites()->latest('favorites.created_at')->paginate(10);
        
        return view('pages.favorites', compact('dataBooks'));
    }

    // Menambah atau menghapus dari favorit (Toggle)
    public function toggle(Book $book)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        // Fitur toggle() otomatis menambah jika belum ada, dan menghapus jika sudah ada
        $user->favorites()->toggle($book->id);

        return back();
    }
}