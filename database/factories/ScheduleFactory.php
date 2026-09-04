<?php

namespace Database\Factories;

use App\Models\Schedule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'day' => fake()->randomElement(['Senin', 'Rabu', 'Jumat', 'Sabtu', 'Minggu']),
            'time_range' => '15.30 - 17.30 WIB',
            'location' => 'GOR Sekolah SMKN 2',
            'focus' => fake()->sentence(6),
            'is_next' => false,
            'order' => fake()->numberBetween(1, 10),
        ];
    }

    /**
     * Indicate that this is the next upcoming session.
     */
    public function nextSession(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_next' => true,
        ]);
    }
}
