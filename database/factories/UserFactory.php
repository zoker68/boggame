<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{

    public function definition(): array
    {
        return [
            'username' => fake()->unique()->username(),
            'email' => fake()->unique()->safeEmail(),
            'balance' => fake()->randomFloat(2, 0, 1000),
            'created_at' => fake()->dateTimeBetween('-5 years'),
        ];
    }

}
