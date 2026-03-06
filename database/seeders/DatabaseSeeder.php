<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Administrator',
            'email' => 'admin@kickcare.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'balance' => 0,
        ]);

        User::create([
            'name' => 'Cashier',
            'email' => 'kasir@kickcare.com',
            'password' => Hash::make('password'),
            'role' => 'kasir',
            'balance' => 0,
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'balance' => 50000,
        ]);

    }
}
