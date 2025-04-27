<?php

namespace Database\Factories;

use App\Enums\GameType;
use App\Enums\TransactionStatus;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition(): array
    {
        return [
            'transaction_id' => 'txn_' . fake()->unique()->randomNumber(),
            'bet_amount' => fake()->randomFloat(2, 0, 1000),
            'game_type' => fake()->randomElement(GameType::class),
            'status' => fake()->randomElement(TransactionStatus::class),
            'created_at' => fake()->dateTimeBetween('-5 years'),

            'user_id' => User::factory(),
        ];
    }
}
