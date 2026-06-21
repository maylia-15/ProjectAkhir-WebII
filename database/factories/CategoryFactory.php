<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * Nama model yang terhubung dengan factory ini.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Definisikan data palsu bawaan untuk isi tabel categories.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $namaKategori = $this->faker->unique()->randomElement(['Organik', 'Anorganik', 'B3 (Berbahaya)']);

        return [
            'nama_kategori' => $namaKategori,
            'slug'          => Str::slug($namaKategori),
            'deskripsi'     => $this->faker->sentence(10),
        ];
    }
}