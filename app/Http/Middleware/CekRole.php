<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekRole
{
    /**
     * "Petugas ruang VIP": cek role user sebelum boleh masuk.
     * Contoh pemakaian di route: ->middleware('role:admin')
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (! in_array($request->user()->role, $roles)) {
            return redirect()->route('dokter.index')
                ->with('error', 'Akses ditolak! Fitur ini khusus ' . implode('/', $roles) . '.');
        }

        return $next($request);
    }
}