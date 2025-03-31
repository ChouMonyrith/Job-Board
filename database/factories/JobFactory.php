<?php

namespace Database\Factories;

use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->jobTitle,
            'description' => fake()->text(255),
            'salary' =>fake()->numberBetween(200,5000),
            'location' => fake()->city,
            'category' => fake()->randomElement([
                'IT',
                'Finance',
                'Engineering',
                'Healthcare',
                'Education',
                'Marketing',
                'Sales',
            ]),
            'experience_level' => fake()->randomElement(Job::$experience)


        ];
    }
}
