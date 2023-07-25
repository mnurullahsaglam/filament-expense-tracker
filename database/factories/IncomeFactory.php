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
            'date' => $this->faker->date(),
            'name' => $this->faker->name(),
            'currency' => CurrencyEnum::getRandomName(),
            'amount' => $this->faker->randomNumber(),
        ];
    }
}
