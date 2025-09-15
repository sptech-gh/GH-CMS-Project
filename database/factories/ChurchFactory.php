<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Church;

class ChurchFactory extends Factory
{
    protected $model = Church::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->company . ' Church';

        return [
            'name' => $name,
            'slug' => Str::slug($name) . '-' . Str::random(5), // ensure uniqueness
            'location' => $this->faker->city,
            'region' => $this->faker->state,
            'denomination' => $this->faker->randomElement(['Pentecostal', 'Charismatic', 'Catholic', 'Baptist']),
            'founded_at' => $this->faker->date(),
            'description' => $this->faker->paragraph,
        ];
    }
}
