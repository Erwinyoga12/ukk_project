<?php

namespace App\Http\Controllers\Kesiswaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthKesiswaanController extends Controller
{
    // Guard khusus kesiswaan
    protected string $guard = 'kesiswaan';

    /**
     * Tampilkan halaman login kesiswaan
     */
    public function showLoginForm()
    {
        // Jika sudah login, redirect ke dashboard kesiswaan
        if (Auth::guard($this->guard)->check()) {
            return redirect()->route('kesiswaan.dashboard');
        }

        return view('kesiswaan.auth.login');
    }

    /**
     * Proses login kesiswaan
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 6 karakter.',
        ]);

        $credentials = $request->only('email', 'password');
        $remember    = $request->boolean('remember');

        if (Auth::guard($this->guard)->attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Cek status akun
            $user = Auth::guard($this->guard)->user();
            if ($user->status === 'nonaktif') {
                Auth::guard($this->guard)->logout();
                return back()->withErrors([
                    'email' => 'Akun Anda tidak aktif. Hubungi administrator.',
                ])->withInput($request->except('password'));
            }

            return redirect()
                ->intended(route('kesiswaan.dashboard'))
                ->with('success', 'Selamat datang, ' . $user->nama . '!');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->withInput($request->except('password'));
    }

    /**
     * Logout kesiswaan
     */
    public function logout(Request $request)
    {
        Auth::guard($this->guard)->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('kesiswaan.login')
            ->with('success', 'Anda berhasil keluar.');
    }

    /**
     * Dashboard kesiswaan (placeholder)
     */
    public function dashboard()
    {
        $user = Auth::guard($this->guard)->user();
        return view('kesiswaan.dashboard', compact('user'));
    }
}