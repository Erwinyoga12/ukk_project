<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Kesiswaan;

class KesiswaanSeeder extends Seeder
{
    public function run(): void
    {
        $dataKesiswaan = [
            [
                'name'     => 'Siti Rahayu, S.Pd',
                'email'    => 'siti.rahayu@sekolah.sch.id',
                'password' => 'kesiswaan123',
            ],
            [
                'name'     => 'Budi Santoso, S.Pd',
                'email'    => 'budi.santoso@sekolah.sch.id',
                'password' => 'kesiswaan123',
            ],
            [
                'name'     => 'Dewi Lestari, S.Pd',
                'email'    => 'dewi.lestari@sekolah.sch.id',
                'password' => 'kesiswaan123',
            ],
        ];

        foreach ($dataKesiswaan as $data) {
            Kesiswaan::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name'     => $data['name'],
                    'password' => Hash::make($data['password']),
                ]
            );
        }

        $this->command->info('✅ Seeder Kesiswaan (Users) berhasil dijalankan!');
    }
}