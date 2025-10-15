<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->randomElement(User::all()->pluck('id')->toArray()),
            'description' => $this->faker->sentence(),
            'unit_cost_price' => $this->faker->randomFloat(2, 0, 1000),
            'quantity' => $this->faker->randomNumber(2),
            'created_at' => fake()->dateTimeBetween('-3 months', 'now'),
        ];
    }
}