<?php

namespace Database\Factories;

use App\Models\Division;
use App\Models\Employee;
use App\Models\PositionName;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Random\RandomException;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Position>
 */
class PositionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws RandomException
     */
    public function definition(): array
    {
        $employmentDate = Carbon::parse(fake()->dateTimeBetween('-2 years'));
        $dismissalDate = $employmentDate->copy()->addDays(random_int(0, 1000));

        return [
            'employee_id' => Employee::inRandomOrder()->first()->id,
            'position_name_id' => PositionName::inRandomOrder()->first()->id,
            'division_id' => Division::inRandomOrder()->first()->id,
            'employment_date' => $employmentDate,
            'dismissal_date' => $dismissalDate > now() ? $dismissalDate : null,
        ];
    }
}
