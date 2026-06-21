<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnnouncementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tipe = fake()->randomElement(['jadwal_kerja_bakti', 'jadwal_truk_sampah', 'himbauan']);

        $judulPerTipe = [
            'jadwal_kerja_bakti' => 'Kerja Bakti Bersama Warga ' . fake()->dayOfWeek(),
            'jadwal_truk_sampah' => 'Jadwal Pengangkutan Truk Sampah Minggu Ini',
            'himbauan' => 'Himbauan: ' . fake()->sentence(4),
        ];

        return [
            'user_id' => User::factory()->admin(),
            'judul' => $judulPerTipe[$tipe],
            'tipe' => $tipe,
            'isi' => fake()->paragraph(4),
        ];
    }
}