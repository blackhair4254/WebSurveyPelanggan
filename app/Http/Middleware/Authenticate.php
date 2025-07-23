<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            // Ganti ini sesuai dengan rute login karyawan kamu
            return route('karyawan'); // misalnya /karyawan
        }
    }
}
