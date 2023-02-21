<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ordersData = [
            [
                'id'      => Order::ID_DEFAULT,
                'user_id' => User::ID_DEFAULT,
            ],
        ];

        foreach ($ordersData as $orderData) {
            if (!Order::find($orderData['id'])) {
                Order::create($orderData);
            }
        }
    }
}
