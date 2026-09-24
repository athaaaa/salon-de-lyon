<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Melindungi seluruh route /admin/* — hanya user dengan role admin/kasir
     * yang berstatus aktif yang boleh masuk.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check() || ! Auth::user()->isAdmin()) {
            Auth::logout();
            return redirect()->route('login')->withErrors([
                'email' => 'Silakan login untuk mengakses halaman admin.',
            ]);
        }

        return $next($request);
    }
}
