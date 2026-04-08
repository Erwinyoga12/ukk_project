<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            // [name => eskul, email => login alternatif, password default]
            ['eskul' => 'pramuka',      'email' => 'pramuka@eskul.com'],
            ['eskul' => 'paskibra',     'email' => 'paskibra@eskul.com'],
            ['eskul' => 'pmr',          'email' => 'pmr@eskul.com'],
            ['eskul' => 'natbinari',    'email' => 'natbinari@eskul.com'],
            ['eskul' => 'jurnal',       'email' => 'jurnal@eskul.com'],
            ['eskul' => 'marchingband', 'email' => 'marchingband@eskul.com'],
        ];

        foreach ($users as $data) {
            User::updateOrCreate(
                ['email' => $data['email']], // unique key
                [
                    'name' => $data['eskul'],           // simpan eskul di 'name'
                    'password' => Hash::make('123'),    // 🔐 Ganti setelah deploy!
                ]
            );
        }
    }
}