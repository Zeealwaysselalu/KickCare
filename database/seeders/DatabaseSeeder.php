<?php

namespace Database\Seeders;

use App\Models\Outlet;
use App\Models\Transaction;
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
            'username' => 'Administrator',
            'email' => 'admin@kickcare.com',
            'password' => Hash::make('password'),
            'role' => 'administrator',
            'balance' => 0,
        ]);

        User::create([
            'username' => 'Cashier',
            'email' => 'kasir@kickcare.com',
            'password' => Hash::make('password'),
            'role' => 'cashier',
            'balance' => 0,
        ]);

        User::create([
            'username' => 'User',
            'name' => 'John Doe',
            'email' => 'user@gmail.com',
            'phone' => '081234567890',
            'password' => Hash::make('password'),
            'role' => 'user',
            'balance' => 50000,
            'status_member' => 'bronze',
        ]);

        User::create([
            'username' => 'User1',
            'name' => 'John Doe',
            'email' => 'user1@gmail.com',
            'phone' => '081234567890',
            'password' => Hash::make('password'),
            'role' => 'user',
            'balance' => 50000,
            'status_member' => 'silver',
        ]);

        User::create([
            'username' => 'User2',
            'name' => 'John Doe',
            'email' => 'user2@gmail.com',
            'phone' => '081234567890',
            'password' => Hash::make('password'),
            'role' => 'user',
            'balance' => 50000,
            'status_member' => 'gold',
        ]);

        Outlet::create([
            'name' => 'Outlet Veteran',
            'address' => 'Jl. Veteran No. 123, Tangerang',
        ]);

        Outlet::create([
            'name' => 'Outlet Serpong',
            'address' => 'Jl. Serpong No. 456, Tangerang',
        ]);

        Transaction::create([
            'transaction_code' => 'KC0000',
            'shoes_name' => 'Nike Air Max',
            'outlet_id' => 1,
            'user_id' => 3,
            'service' => 'wash',
            'status' => 'completed',
            'total_price' => 250000.00,
        ]);

        Transaction::create([
            'transaction_code' => 'KC0001',
            'customer_name' => 'John Doe',
            'shoes_name' => 'Adidas Ultraboost',
            'shoes_color' => 'Black/White',
            'outlet_id' => 1,
            'user_id' => 3,
            'service' => 'wash',
            'status' => 'completed',
            'total_price' => 300000.00,
        ]);

        Transaction::create([
            'transaction_code' => 'KC0002',
            'customer_name' => 'John Doe',
            'shoes_name' => 'Puma RS-X',
            'shoes_color' => 'Black/White',
            'outlet_id' => 1,
            'user_id' => 3,
            'service' => 'wash',
            'status' => 'completed',
            'total_price' => 200000.00,
        ]);

        Transaction::create([
            'transaction_code' => 'KC0003',
            'customer_name' => 'John Doe',
            'shoes_name' => 'Reebok Classic',
            'shoes_color' => 'Black/White',
            'outlet_id' => 1,
            'user_id' => 3,
            'service' => 'wash',
            'status' => 'completed',
            'total_price' => 150000.00,
        ]);

        Transaction::create([
            'transaction_code' => 'KC0004',
            'customer_name' => 'John Doe',
            'shoes_name' => 'New Balance 574',
            'shoes_color' => 'Black/White',
            'outlet_id' => 1,
            'user_id' => 3,
            'service' => 'wash',
            'status' => 'completed',
            'total_price' => 180000.00,
        ]);
    }
}
