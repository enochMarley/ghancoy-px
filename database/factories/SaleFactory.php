<?php

namespace Database\Factories;

use App\Enum\SaleType;
use App\Models\Personnel;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $saleType = fake()->randomElement(SaleType::cases());
        $personnelId = null;
        if ($saleType == SaleType::CREDIT) {
            $personnelId = fake()->randomElement(Personnel::all()->pluck('id')->toArray());
        } else {
            $personnelId = null;
        }

        return [
            'stock_id' => fake()->randomElement(Stock::all()->pluck('id')->toArray()),
            'personnel_id' => $personnelId,
            'quantity' => $this->faker->numberBetween(1, 3),
            'sale_type' => $saleType,
        ];
    }
}
