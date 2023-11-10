<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(2),
            'description' => $this->faker->paragraph(3),
            'low_stock_qty' => 10,
            'initial_stock_qty' => 0,
            'current_stock_qty' => 0,
            'sku' => $this->faker->ean13(),
            'createdBy' => 1
        ];
    }
}
