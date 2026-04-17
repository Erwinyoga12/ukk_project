<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthKesiswaanController extends Controller
{
    /**
     * Tampilkan form login.
     * Kalau sudah login → langsung ke dashboard.
     */
    public function showLoginForm()
    {
        if (Auth::guard('kesiswaan')->check()) {
            return redirect()->route('kesiswaan.dashboard');
        }

        return view('kesiswaan.login');
    }

    /**
     * Proses login.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ]);

        $remember = $request->boolean('remember');

        if (!Auth::guard('kesiswaan')->attempt($credentials, $remember)) {
            return back()
                ->withErrors(['email' => 'Email atau password salah.'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('kesiswaan.dashboard'));
    }

    /**
     * Logout.
     */
    public function logout(Request $request)
    {
        Auth::guard('kesiswaan')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('kesiswaan.login')
            ->with('success', 'Berhasil keluar. Sampai jumpa!');
    }

    /**
     * Dashboard — delegate ke SiswaController@index
     * agar logika data tetap di controller yang tepat.
     */
    public function dashboard()
    {
        return app(SiswaController::class)->index();
    }
}
