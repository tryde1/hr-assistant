<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\PositionName;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'passport_series' => fake()->numerify('####'),
            'passport_number' => fake()->numerify('######'),
            'achievement_list' => fake()->realText,
            'characteristic' => fake()->realText,
        ];
    }
}
