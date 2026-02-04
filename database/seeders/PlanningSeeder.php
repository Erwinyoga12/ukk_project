<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PlanningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'name' => 'sol',
            'email' => 'solehasiti17@gmail.com',
            'password' => bcrypt ('129')
        ]);
    }
}
