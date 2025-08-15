<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ChurchFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->company . ' Church',
            'slug' => null, // Let the model handle slug generation
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'website' => $this->faker->url,
            'description' => $this->faker->paragraph,
            'founded_year' => $this->faker->year,
        ];
    }
}
