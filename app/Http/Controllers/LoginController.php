<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
{
    $akun = [
        'pramuka' => ['password' => '123', 'eskul' => 'pramuka'],
        'paskibra' => ['password' => '123', 'eskul' => 'paskibra'],
        'pmr' => ['password' => '123', 'eskul' => 'pmr'],
        'natbinari' => ['password' => '123', 'eskul' => 'natbinari'],
        'jurnal' => ['password' => '123', 'eskul' => 'jurnal'],
    ];

    $username = strtolower($request->username);
    $password = $request->password;

    if (isset($akun[$username]) && $akun[$username]['password'] == $password) {

        session(['eskul_login' => $akun[$username]['eskul']]);

        return redirect('/eskul');
    }

    return back()->with('error', 'Username atau password salah');
}
}
