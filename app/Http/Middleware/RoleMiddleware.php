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
        // Pastikan pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect ke halaman login jika belum login
        }

        // Ambil user yang sedang login
        $user = Auth::user();

        // Periksa apakah role pengguna sesuai
        if ($user->role !== $role) {
            abort(403, 'Unauthorized action.'); // Abort dengan pesan 403 jika role tidak sesuai
        }
        return $next($request);
    }
}
