<?php

namespace Database\Factories;

use App\Models\Achievement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Achievement>
 */
class AchievementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'category_name' => fake()->randomElement(['Tunggal Putra', 'Tunggal Putri', 'Ganda Putra', 'Ganda Putri', 'Beregu Campuran']),
            'year' => fake()->numberBetween(2022, 2026),
            'rank' => 'Juara 1',
            'medal_type' => 'gold',
            'image_url' => null,
            'athlete_names' => fake()->name(),
        ];
    }

    /**
     * Indicate gold medal.
     */
    public function gold(): static
    {
        return $this->state(fn (array $attributes) => [
            'rank' => 'Juara 1',
            'medal_type' => 'gold',
        ]);
    }

    /**
     * Indicate silver medal.
     */
    public function silver(): static
    {
        return $this->state(fn (array $attributes) => [
            'rank' => 'Juara 2',
            'medal_type' => 'silver',
        ]);
    }

    /**
     * Indicate bronze medal.
     */
    public function bronze(): static
    {
        return $this->state(fn (array $attributes) => [
            'rank' => 'Juara 3',
            'medal_type' => 'bronze',
        ]);
    }
}
