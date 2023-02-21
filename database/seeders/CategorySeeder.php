<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoriesData = [
            [
                'id'   => Category::ID_EXPENSIVE,
                'name' => Category::EXPENSIVE_NAME,
            ],
            [
                'id'   => Category::ID_MEDUIM,
                'name' => Category::MEDIUM_NAME,
            ],
            [
                'id'   => Category::ID_CHEAP,
                'name' => Category::CHEAP_NAME,
            ],
            
            [
                'id'   => Category::ID_CARS,
                'name' => Category::CARS_NAME,
            ],
            [
                'id'   => Category::ID_HOUSES,
                'name' => Category::HOUSES_NAME,
            ],
            [
                'id'   => Category::ID_CLOTHES,
                'name' => Category::CLOTHES_NAME,
            ]
        ];

        foreach ($categoriesData as $categoryData) {
            if (!Category::find($categoryData['id'])) {
                Category::create($categoryData);
            }
        }
    }
}
