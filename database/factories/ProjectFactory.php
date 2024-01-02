<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start_date = fake()->dateTimeBetween('-6 months', '+1 year')->format('Y-m-d');
        $end_date = fake()->dateTimeBetween($start_date, "+2 years")->format('Y-m-d');
        if (date("Y-m-d") < $start_date) {
            $status = "受注前";
        } else if ($end_date > date("Y-m-d")) {
            $status = "構築中";
        } else {
            $status = "納品済み";
        }
        return [
            'project_name' => fake()->realText($maxNbChars = 30),
            'customer_name'=> fake()->company(),
            'details'=> fake()->realText($maxNbChars = 700, $indexSize = 5),
            'start_date'=>$start_date,
            'end_date'=> $end_date,
            'hours_required_per_month'=>fake()->numberBetween(120, 160),
            'cost'=>fake()->numberBetween(1000000, 10000000),
            'status'=>$status
        ];
    }
}
