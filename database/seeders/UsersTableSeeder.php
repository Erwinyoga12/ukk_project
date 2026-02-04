<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'name' => 'melody',
            'email' => 'melody@gmail.com',
            'password' => bcrypt('2025')
        ]);
    }

    
}
