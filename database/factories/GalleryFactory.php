<?php

namespace Database\Factories;

use App\Models\Gallery;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Gallery>
 */
class GalleryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'caption' => fake()->sentence(8),
            'category' => fake()->randomElement(['tim', 'latihan', 'pertandingan']),
            'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCjh4jyTU84WyHY0NEppmXzli5zaa5yLvU9EuZvxHczkZIaSQc4AxoDWnnig8Ik02PsklCy2fg61B7yk1EQers76vZT_zazbVIj_JmccJxELMcYN_u_JGNucNLF8-AI5qFjU4OMZFsqYW4F8JnI2UMdnxYALXeBx_8TwJgcvsFDNzXsJJLOeYDutmVC4npas5s1-kJGGt-LtGpcOxUtcT_3F0ZO4sHeQvRVzgASlyuOXtMEgU6Xp_loxA',
            'span_class' => 'col-span-1',
        ];
    }
}
