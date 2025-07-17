<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CourseHole>
 */
class CourseHoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'hole_number' => $this->faker->numberBetween(1, 18),
            'par' => $this->faker->randomElement([3, 4, 5]),
            'yardage' => $this->faker->numberBetween(100, 600),
        ];
    }
}
