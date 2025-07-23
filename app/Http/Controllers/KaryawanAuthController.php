<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class KaryawanAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = Karyawan::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'Email atau password salah'], 401);
        }

        // Tambahkan log debug ini
        Log::info('Password dari input: ' . $request->password);
        Log::info('Password dari database: ' . $user->password);
        Log::info('Password cocok? ' . (Hash::check($request->password, $user->password) ? 'ya' : 'tidak'));

        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Email atau password salah'], 401);
        }

        // Jika cocok, lanjutkan proses autentikasi
        Auth::guard('karyawan')->login($user);


        return response()->json([
            'success' => true
        ]);


    }
}

