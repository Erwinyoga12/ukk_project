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
            ['eskul' => 'pramuka',      'email' => 'pramuka@eskul.com',      'password' => 'pramuka2026'],
            ['eskul' => 'paskibra',     'email' => 'paskibra@eskul.com',     'password' => 'paskibra2026'],
            ['eskul' => 'pmr',          'email' => 'pmr@eskul.com',          'password' => 'pmr2026'],
            ['eskul' => 'natbinari',    'email' => 'natbinari@eskul.com',    'password' => 'natbinari2026'],
            ['eskul' => 'jurnal',       'email' => 'jurnal@eskul.com',       'password' => 'jurnal2026'],
            ['eskul' => 'marchingband', 'email' => 'marchingband@eskul.com', 'password' => 'marchingband2026'],
        ];

        foreach ($users as $data) {
            User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name'     => $data['eskul'],
                    'password' => Hash::make($data['password']),
                ]
            );
        }
    }
}