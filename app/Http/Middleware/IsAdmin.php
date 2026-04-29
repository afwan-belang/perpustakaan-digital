<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user yang login memiliki role 'admin'
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request); // Silakan lewat
        }

        // Jika user biasa mencoba masuk, tendang dengan pesan error 403 Forbidden
        abort(403, 'Akses Ditolak. Halaman ini khusus Administrator.');
    }
}