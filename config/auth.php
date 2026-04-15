<?php

// ============================================================
// Tambahkan bagian berikut ke dalam config/auth.php
// di array 'guards' dan 'providers' yang sudah ada
// ============================================================

return [

    'defaults' => [
        'guard'     => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver'   => 'session',
            'provider' => 'users',
        ],

        // ✅ TAMBAHKAN INI
        'kesiswaan' => [
            'driver'   => 'session',
            'provider' => 'kesiswaan',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model'  => App\Models\User::class,
        ],

        // ✅ TAMBAHKAN INI
        'kesiswaan' => [
            'driver' => 'eloquent',
            'model'  => App\Models\Kesiswaan::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table'    => 'password_reset_tokens',
            'expire'   => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,
];