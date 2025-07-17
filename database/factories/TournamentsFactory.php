<?php

namespace Database\Factories;

use App\Models\CourseDetail;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tournaments>
 */
class TournamentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('+1 week', '+6 months');
        $end = (clone $start)->modify('+'.rand(1, 4).' days');
        $entriesClose = (clone $start)->modify('-'.rand(1, 14).' days');

        // Fees between 0 and 1000 (decimal 2)
        $fee = fn() => $this->faker->randomFloat(2, 0, 1000);

        // Sample handicaps as strings like "0-18", "19-36" or "Open"
        $handicapOptions = ['0-18', '19-36', 'Open', 'Scratch'];

        return [
            'tournament_title' => 'ZGA Open - ' . $this->faker->city(),
            'presenter' => $this->faker->company(),
            'course_detail_id' => CourseDetail::factory(),
            'location_code' => $this->faker->optional()->bothify('???-###'),
            'start_date' => Carbon::instance($start)->toDateString(),
            'end_date' => Carbon::instance($end)->toDateString(),
            'entries_close' => Carbon::instance($entriesClose)->toDateString(),
            'rounds' => 3,
            'ladies_champ_handicap' => $this->faker->randomElement($handicapOptions),
            'ladies_champ_fee' => $fee(),
            'ladies_net_handicap' => $this->faker->randomElement($handicapOptions),
            'ladies_net_fee' => $fee(),
            'men_champ_handicap' => $this->faker->randomElement($handicapOptions),
            'men_champ_fee' => $fee(),
            'men_net_handicap' => $this->faker->randomElement($handicapOptions),
            'men_net_fee' => $fee(),
        ];
    }
}
