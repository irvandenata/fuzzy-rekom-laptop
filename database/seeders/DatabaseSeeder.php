<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
        Role::create([
            'name' => "admin",
        ]);
        Role::create([
            'name' => "operator",
        ]);

        User::create([
            'name' => "irvan",
            'email' => "irvan@gmail.com",
            'password' => Hash::make('password'),
            'role_id' => 1,
        ]);
        User::create([
            'name' => "irvan",
            'email' => "operator@mail.com",
            'password' => Hash::make('password'),
            'role_id' => 2,
        ]);

    }
}
