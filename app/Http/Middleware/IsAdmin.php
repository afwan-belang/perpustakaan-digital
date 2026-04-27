<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek 1: Apakah user sudah login?
        if (! $request->user()) {
            return redirect()->route('login');
        }

        // Cek 2: Apakah role-nya BUKAN admin?
        if ($request->user()->role !== 'admin') {
            abort(403, 'ANDA BUKAN ADMIN!'); 
        }

        return $next($request);
    }
}