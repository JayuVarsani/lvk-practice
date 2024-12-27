<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use function Laravel\Prompts\text;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PurchaseOrder>
 */
class PurchaseOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_no'=>fake()->numberBetween(1,100),
            'priority'=>fake()->randomElement(['sync','not sync']),
            'priority_so'=>fake()->text(10),
            'created_at'=>fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
