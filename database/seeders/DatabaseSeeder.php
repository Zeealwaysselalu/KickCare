<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\{DetailTransaction, Outlet, Transaction, TransactionItem, User};

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'username' => 'Administrator',
            'email' => 'admin@kickcare.com',
            'password' => Hash::make('password'),
            'role' => 'administrator',
            'balance' => 0,
        ]);

        $cashier1 = User::create([
            'username' => 'CashierVeteran',
            'email' => 'kasirveteran@kickcare.com',
            'password' => Hash::make('password'),
            'role' => 'cashier',
            'balance' => 0,
        ]);

        $cashier2 = User::create([
            'username' => 'CashierSepong',
            'email' => 'kasirserpong@kickcare.com',
            'password' => Hash::make('password'),
            'role' => 'cashier',
            'balance' => 0,
        ]);

        $user = User::create([
            'username' => 'User',
            'name' => 'John Doe',
            'email' => 'user@gmail.com',
            'phone' => '081234567890',
            'password' => Hash::make('password'),
            'role' => 'user',
            'balance' => 50000,
            'status_member' => 'bronze',
        ]);

        $outlets = [
            Outlet::create([
                'name' => 'Outlet Veteran',
                'address' => 'Jl. Veteran No. 123, Tangerang',
                'user_id' => $cashier1->id,
            ]),
            Outlet::create([
                'name' => 'Outlet Serpong',
                'address' => 'Jl. Serpong No. 456, Tangerang',
                'user_id' => $cashier2->id,
            ]),
        ];

        $shoesList = [
            'Nike Air Max',
            'Adidas Ultraboost',
            'Puma RS-X',
            'Reebok Classic',
            'New Balance 574',
            'Vans Old Skool',
            'Converse Chuck Taylor',
            'Asics Gel Lyte',
        ];

        $services = ['wash', 'unyellowing', 'repaint'];

        $code = 1;

        foreach ($outlets as $outlet) {

            for ($i = 0; $i < 5; $i++) {

                $transaction = Transaction::create([
                    'transaction_code' => 'KC' . str_pad($code, 4, '0', STR_PAD_LEFT),
                    'outlet_id' => $outlet->id,
                    'user_id' => $user->id,
                    'total_price' => rand(100000, 300000),
                ]);

                $shoes = $shoesList[array_rand($shoesList)];
                $service = $services[array_rand($services)];

                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'customer_name' => 'John Doe',
                    'shoes_name' => $shoes,
                    'shoes_color' => 'Black/White',
                    'service' => $service,
                ]);

                DetailTransaction::create([
                    'transaction_id' => $transaction->id,
                    'status' => 'completed',
                    'progress_status' => 'ready',
                    'cancel_reason' => null,
                ]);

                $code++;
            }
        }
    }
}
