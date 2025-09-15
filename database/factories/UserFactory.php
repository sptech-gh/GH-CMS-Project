<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Church;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // default password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Configure the model after creating.
     */
    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            // Pick one or more random churches
            $churches = Church::inRandomOrder()->take(rand(1, 2))->pluck('id');

            if ($churches->isEmpty()) {
                // If no churches exist, create some first
                $churches = Church::factory(3)->create()->pluck('id');
            }

            // Attach with random role
            foreach ($churches as $churchId) {
                $user->churches()->attach($churchId, [
                    'role' => $this->faker->randomElement(['admin', 'member']),
                ]);
            }
        });
    }
}
