<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ControllerAuth extends Controller
{
    public function index()
    {
        return view('gin');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $input    = strtolower($request->username);
        $password = $request->password;

        $user = User::where('email', $input)
                    ->orWhere('name', $input)
                    ->first();

        if ($user && Hash::check($password, $user->password)) {
            session([

                'eskul_login' => $user->name,
                'eskul_login' => strtolower($user->name), // <-- FIX
                'user_id'     => $user->id,
                'logged_in'   => true,
            ]);
            session()->save(); // ← pastikan session tersimpan sebelum redirect
            return redirect('/eskul');
        }

        return redirect()->back()->withInput()->with('pesan', 'Username atau password salah');
    }
}
