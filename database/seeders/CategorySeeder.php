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
        //
        $categories = [
            ['name' => 'Appetizers', 'description' => 'Start your meal right'],
            ['name' => 'Main Course', 'description' => 'Hearty main dishes'],
            ['name' => 'Desserts', 'description' => 'Sweet treats'],
            ['name' => 'Beverages', 'description' => 'Drinks and refreshments'],
            ['name' => 'Salads', 'description' => 'Fresh and healthy options'],
            ['name' => 'Soups', 'description' => 'Warm and comforting'],
            ['name' => 'Breakfast', 'description' => 'Morning favorites'],
            ['name' => 'Pizza', 'description' => 'Hot and delicious pizzas'],
            ['name' => 'Burgers', 'description' => 'Juicy burgers'],
            ['name' => 'Seafood', 'description' => 'Fresh from the ocean'],
        ];


        foreach ($categories as $category) {
            Category::create($category);  // Using create(), not factory()
        }
    }
}
