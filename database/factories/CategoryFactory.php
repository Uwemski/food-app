<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Category::class;
    
    public function definition(): array
    {
        return [
            //
            'name' => ucfirst($this->faker->unique()->word()),
            'description' => $this->faker->sentence(12),
            'image' => 'categories/' . $this->faker->numberBetween(1, 5) . '.jpg',
            'is_available' => $this->faker->randomElement([
                'available',
                'unavailable',
            ]),
        ];
    }
}
