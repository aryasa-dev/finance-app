<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'             => fake()->sentence(3),
            'amount'           => fake()->randomFloat(2, 10000, 1000000),
            // 'amount'           => number_format(fake()->randomFloat(2, 10000, 1000000), 2, ',', '.'),
            'type'             => fake()->randomElement(['income', 'expense']),
            'category_id'      => fake()->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
            'description'      => fake()->sentence(4),
            // 'transaction_date' => fake()->dateTimeThisYear()->format('Y-m-d'),
            'transaction_date' => fake()->dateTimeBetween('2024-01-01', '2024-12-31')->format('Y-m-d'),
        ];
    }
}
