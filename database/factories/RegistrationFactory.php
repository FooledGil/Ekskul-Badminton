<?php

namespace Database\Factories;

use App\Models\Registration;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Registration>
 */
class RegistrationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'registration_code' => 'BDM-'.date('Y').'-'.fake()->unique()->numerify('###'),
            'name' => fake()->name(),
            'class_major' => fake()->randomElement(['X RPL 1', 'X RPL 2', 'XI DKV 1', 'XI TKJ 2', 'XII AKL 1']),
            'whatsapp_number' => fake()->unique()->numerify('08##########'),
            'gender' => fake()->randomElement(['L', 'P']),
            'preferred_category' => fake()->randomElement(['Tunggal Putra', 'Tunggal Putri', 'Ganda Putra', 'Ganda Putri', 'Ganda Campuran']),
            'experience_level' => fake()->randomElement(['Pemula', 'Menengah', 'Mahir']),
            'motivation' => fake()->sentence(10),
            'status' => 'menunggu',
            'coach_notes' => null,
        ];
    }

    /**
     * Indicate that the registration is accepted.
     */
    public function accepted(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'diterima',
            'coach_notes' => 'Lolos verifikasi berkas dan tes fisik.',
        ]);
    }

    /**
     * Indicate that the registration is rejected.
     */
    public function rejected(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'ditolak',
            'coach_notes' => 'Kouta pendaftar telah terpenuhi untuk periode ini.',
        ]);
    }
}
