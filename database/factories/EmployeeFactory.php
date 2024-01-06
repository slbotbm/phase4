<?php

namespace Database\Factories;

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
            'name'=>fake()->name(),
            'age'=>fake()->numberBetween(18, 50),
            'sex'=>fake()->randomElement(["男性","女性"]),
            'start_of_employment'=>fake()->dateTimeBetween('-8 years', 'now'),
            'profile_url'=>'https://fusic.co.jp/members/' . fake()->numberBetween(1, 100),
        ];
    }
}
