<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => $this->faker->unique()->company(),
            "description" => $this->faker->sentence(100, true),
            "price" => $this->faker->randomFloat(2, 0, 4000),
            "image" => $this->faker->unique()->filePath(),
        ];
    }
}
