<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;
use \App\Models\Employee;
use \App\Models\Position;
use \App\Models\Project;
use \App\Models\Technology;
use \Database\Factories\PositionFactory;
use \Database\Factories\TechnologyFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $position_names = PositionFactory::$position_names;
        foreach($position_names as $position) {
            Position::factory()->create([
                'position_name' => $position,
            ]);
        }


        $technology_names = array_keys(TechnologyFactory::$technology);
        foreach ($technology_names as $technology_name) {
            Technology::factory()->create([
                'technology_name' => $technology_name,
                'technology_field' => TechnologyFactory::$technology[$technology_name],
            ]);
        }
        
        Employee::factory(100)->create()->each(function($employee){
            
            $start_employment = $employee->start_of_employment;
            $position_start_date = $start_employment->subSeconds(rand(0, now()->diffInSeconds($start_employment)));
            $position = Position::inRandomOrder()->first();
            $employee->positions()->attach($position, ['employee_position_start_date' => $position_start_date]);

            $number_of_technologies = rand(1, 3);
            $technologies = Technology::inRandomOrder()->limit($number_of_technologies)->distinct()->get();
            foreach($technologies as $technology) {
                $employee->technologies()->attach($technology);
            }
        });

        Project::factory(20)->create()->each(function($project){
            $number_of_technologies = rand(3, 5);
            $technologies = Technology::inRandomOrder()->limit($number_of_technologies)->distinct()->get();
            foreach($technologies as $technology) {
                $project->technologies()->attach($technology);
            }

            $number_of_employees = rand(3, 6);
            $employees = Employee::inRandomOrder()->limit($number_of_employees)->distinct()->get();
            foreach($employees as $employee) {
                $project->employees()->attach($employee, ['employee_project_hours'=> rand(40, 80)] );
            }
        });
        
    }
}
;