<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ControllerAuth extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function cek_akun(Request $request)
    {
        // Validasi input biar gak kosong atau aneh
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $username = $request->username;
        $password = $request->password;

        $user = User::where('name', $username)->first();

        // Kalau user gak ketemu
        if (!$user) {
            return redirect()->route('login')->with('pesan', 'Username atau password salah!');
        }

        // Kalau password salah
        if (Hash::check($password, $user->password)) {
            return redirect()->route('login')->with('pesan', 'SALAH!');
        }

        // Kalau berhasil login
        Auth::login($user);
        return redirect()->route('dashboard');
        
    }
}
