<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Technology>
 */
class TechnologyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public static $technology = [
        'React' => 'frontend',
        'Angular' => 'frontend',
        'Vue' => 'frontend',
        'Vite' => 'frontend',
        'Svelte' => 'frontend',
        'Next' => 'frontend',
        'TypeScript' => 'frontend',
        'Gatsby' => 'frontend',
        'React Native' => 'frontend',
        'Flutter' => 'frontend',
        'Astro' => 'frontend',
        'Three.js' => 'frontend',
        'Tailwind' => 'frontend',
        'GraphQL' => 'frontend',
        'Firebase' => 'server-side',
        'Parse' => 'server-side',
        'MongoDB' => 'server-side',
        'Heroku' => 'server-side',
        'AWS Amplify' => 'server-side',
        'Backendless' => 'server-side',
        'Express.js' => 'backend',
        'Laravel' => 'backend',
        'Firebase' => 'backend',
        'Django' => 'backend',
        'Ruby on Rails' => 'backend',
        'Firebase' => 'backend',
        'CakePHP' => 'backend',
    ];
    public function definition(): array
    {
        $technology_name = fake()->randomElement(array_keys(self::$technology));
        return [
            'name'=> $technology_name,
            'technology_field'=> self::$technology[$technology_name]
        ];
    }
}
