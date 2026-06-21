<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    /**
     * Nama model yang terhubung dengan factory ini.
     *
     * @var string
     */
    protected $model = Tag::class;

    /**
     * Definisikan data palsu bawaan untuk isi tabel tags.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_tag' => $this->faker->unique()->randomElement([
                'Bau Menyengat',
                'Menumpuk',
                'Berserakan',
            ]),
        ];
    }
}