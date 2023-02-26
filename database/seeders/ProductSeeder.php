<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Currency;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productsData = [
            [
                'id'            => Product::ID_DEFAULT_CAR,
                'name'          => 'Lamborgini',
                'price'         => 2000000,
                'order_id'      => Order::ID_DEFAULT,
                'categories'    => [Category::ID_CARS, Category::ID_EXPENSIVE],
                'currency_name' => Currency::DEFAULT_CURRENCY_NAME,
            ],
            [
                'id'            => Product::ID_DEFAULT_HOUSE,
                'name'          => 'Appartments in Crimea',
                'price'         => 100000000,
                'order_id'      => Order::ID_DEFAULT,
                'categories'    => [Category::ID_HOUSES, Category::ID_EXPENSIVE],
                'currency_name' => Currency::DEFAULT_CURRENCY_NAME,
            ],
            [
                'id'            => Product::ID_DEFAULT_CLOTHES,
                'name'          => 'Kendrick Lamar merch',
                'price'         => 500,
                'order_id'      => Order::ID_DEFAULT,
                'categories'    => [Category::ID_CLOTHES, Category::ID_MEDUIM],
                'currency_name' => Currency::DEFAULT_CURRENCY_NAME,
            ]
        ];

        foreach ($productsData as $productData) {
            if (!Product::find($productData['id'])) {
                $product = Product::create([
                    'id' => $productData['id'],
                    'name' => $productData['name'],
                    'price' => $productData['price'],
                    'order_id' => $productData['order_id'],
                ]);
                
                $product->categories()->attach($productData['categories']);
            }
        }
    }
}
