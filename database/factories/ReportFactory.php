<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->warga(),
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(),
            'judul' => fake()->randomElement([
                'Sampah menumpuk di depan rumah',
                'Tong sampah rusak dan berbau',
                'Sampah tidak diangkut 3 hari',
                'Penumpukan sampah di selokan',
                'Sampah berserakan dekat taman komplek',
                'Bau menyengat dari tempat pembuangan sementara',
                'Sampah B3 dibuang sembarangan',
            ]),
            'deskripsi' => fake()->paragraph(3),
            'lokasi' => 'Blok ' . fake()->randomLetter() . ' No. ' . fake()->numberBetween(1, 30),
            'status' => fake()->randomElement(['menunggu', 'diproses', 'selesai', 'ditolak']),
        ];
    }

    public function menunggu(): static
    {
        return $this->state(fn (array $attributes) => ['status' => 'menunggu']);
    }

    public function diproses(): static
    {
        return $this->state(fn (array $attributes) => ['status' => 'diproses']);
    }

    public function selesai(): static
    {
        return $this->state(fn (array $attributes) => ['status' => 'selesai']);
    }
}