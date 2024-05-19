<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->text(200),
            'make' => $this->faker->randomElement(['Ford', 'Toyota', 'Honda', 'Chevrolet']),
            'model' => $this->faker->word,
            'colour' => $this->faker->safeColorName,
            'year' => $this->faker->year($max = 'now'),
            'transmission' => $this->faker->randomElement(['automatic', 'manual']),
            'car_type' => $this->faker->randomElement(['sedan', 'SUV', 'hatchback', 'coupe']),
            'price' => $this->faker->randomFloat(2, 5000, 40000),
            'photo' => $this->faker->imageUrl(640, 480, 'cars', true),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
