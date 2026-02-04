<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UsersTableSeeder::class,
        ]);

        User::create([
            'name' => 'atar1',
            'email' => 'atar11@gmail.com',
            'password' => bcrypt('123'),
        ]);

        User::create([
            'name' => 'atar2',
            'email' => 'atar13@gmail.com',
            'password' => bcrypt('123'),
        ]);

        User::create([
            'name' => 'atar3',
            'email' => 'atar12@gmail.com',
            'password' => bcrypt('123'),
        ]);
    }
}
