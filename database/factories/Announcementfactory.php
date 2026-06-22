<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Announcement>
 */
class AnnouncementFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->admin(),
            'judul'   => fake()->sentence(5),
            'isi'     => fake()->paragraph(4),
        ];
    }
}