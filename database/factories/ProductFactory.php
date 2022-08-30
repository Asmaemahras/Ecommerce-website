<?php

namespace Database\Factories;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'name' => $this->faker->sentence(),
            'description' => $this->faker->sentences(rand(1, 3), true), //de 1 à 3 paragraphes
            'image' => $this->faker->imageUrl(),
            'price' => rand(10, 1000), // prix entre 10 e -> 1000 e
            'active' => $this->faker->boolean(80)
        ];
    }
}
