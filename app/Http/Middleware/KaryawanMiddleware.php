<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KaryawanMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('karyawan')->check()) {
            return redirect()->route('karyawan'); // Ganti jika perlu
        }

        return $next($request);
    }
}
