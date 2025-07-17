<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CourseDetail>
 */
class CourseDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->company . ' Golf Club',
            'location' => $this->faker->city . ', ' . $this->faker->country,
            'description' => $this->faker->paragraph,
            'par' => 72,
            'total_yardage' => $this->faker->numberBetween(6500, 7500),
        ];
    }
}
