<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
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
            'course_id' => \App\Models\Course::inRandomOrder()->first()?->id ?? \App\Models\Course::factory(),
            'year' => fake()->numberBetween(1, 5),
            'profile_picture' => null,
        ];
    }
}
