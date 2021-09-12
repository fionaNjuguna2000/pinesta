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
        User::create([
            'name' => "Erick Miano",
            'email' =>'miano@gmail.com',
'password'=>bcrypt('password'),
            'role' => 1,

        ]);
        // \App\Models\User::factory(10)->create();
    }
}
