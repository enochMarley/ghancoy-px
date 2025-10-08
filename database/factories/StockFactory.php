<?php

namespace Database\Factories;

use App\Enum\QuantityType;
use App\Enum\StockCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stock>
 */
class StockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $costPrice = fake()->randomDigit() * 1000;
        $sellingPrice = $costPrice + fake()->randomDigit() * 1000;
        return [
            'name' => fake()->unique()->word(),
            'category' => fake()->randomElement(StockCategory::cases()),
            'description' => fake()->text(),
            'unit_cost_price' => $costPrice,
            'unit_selling_price' => $sellingPrice,
            'quantity' => random_int(80, 200),
            'quantity_type' => fake()->randomElement(QuantityType::cases()),
        ];
    }
}
