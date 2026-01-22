<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $foodNames = [
            'Grilled Chicken',
            'Caesar Salad',
            'Margherita Pizza',
            'Beef Burger',
            'Pasta Carbonara',
            'Fish and Chips',
            'Chocolate Cake',
            'Cappuccino',
            'Greek Salad',
            'Mushroom Soup',
        ];

        return [
            'name' => $this->faker->randomElement($foodNames),
            'description' => $this->faker->sentence(10),
            'price' => $this->faker->numberBetween(1000, 5000),
            'categories_id' => Category::inRandomOrder()->first()->id,
            'image' => json_encode([
                'products/1.jpg',
                'products/2.jpg',
            ]),
        ];
    }
}