<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Position>
 */
class PositionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     public static $position_names = [
        'エンジニア',
        '営業者'
     ];
    public function definition(): array
    {
        return [
            'position_name'=>fake()->randomElement(self::$position_names)
        ];
    }
}
