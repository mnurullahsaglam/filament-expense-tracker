<?php

namespace Database\Factories;

use App\Enums\CurrencyEnum;
use App\Models\Category;
use App\Models\Income;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncomeFactory extends Factory
{
    protected $model = Income::class;

    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'date' => fake()->date(),
            'name' => fake()->name(),
            'currency' => CurrencyEnum::getRandomName(),
            'amount' => fake()->numberBetween(1, 1000),
        ];
    }
}
