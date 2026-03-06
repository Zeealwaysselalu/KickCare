<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
  {
    // 1. Cek apakah user sudah login
    if (!Auth::check()) {
      return redirect('/login');
    }


    // 2. Cek apakah role user SAMA dengan role yang diizinkan (misal: 'admin')
    if (Auth::user()->role === $role) {
      return $next($request); // Silahkan masuk
    }


    // 3. Jika bukan admin, tampilkan pesan error Akses Ditolak
    abort(403, 'Akses Ditolak! Halaman ini hanya untuk Admin.');
  }

}
