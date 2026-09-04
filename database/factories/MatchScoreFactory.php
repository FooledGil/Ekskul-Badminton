<?php

namespace Database\Factories;

use App\Models\MatchScore;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MatchScore>
 */
class MatchScoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tournament' => fake()->sentence(3),
            'category' => fake()->randomElement(['Tunggal Putra', 'Tunggal Putri', 'Ganda Putra', 'Ganda Putri']),
            'team_a_name' => 'SMKN 2 Purwakarta',
            'team_b_name' => 'SMAN 1 Purwakarta',
            'team_a_sets' => 2,
            'team_b_sets' => 1,
            'score_details' => '21-18 | 19-21 | 21-16',
            'status' => 'selesai',
            'is_active_highlight' => false,
        ];
    }

    /**
     * Indicate that this match is currently live.
     */
    public function live(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'live',
            'is_active_highlight' => true,
        ]);
    }

    /**
     * Indicate that this match is highlighted on scoreboard.
     */
    public function highlighted(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active_highlight' => true,
        ]);
    }
}
