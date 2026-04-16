<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthKesiswaanController extends Controller
{
    protected string $guard = 'kesiswaan';

    public function showLoginForm()
    {
        if (Auth::guard($this->guard)->check()) {
            return redirect()->route('kesiswaan.dashboard');
        }

        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::guard($this->guard)->attempt(
            $request->only('email', 'password'),
            $request->boolean('remember')
        )) {
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard($this->guard)->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('kesiswaan.login')->with('success', 'Berhasil keluar.');
    }

    public function dashboard()
    {
       return view('dashboard');
    }
}
