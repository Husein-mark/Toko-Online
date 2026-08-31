<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('error', 'Anda harus login terlebih dahulu.');
        }

        if (!auth()->user()->isAdmin()) {
            abort(403, 'Akses ditolak. Halaman ini khusus untuk Admin.');
        }

        return $next($request);
    }
}
