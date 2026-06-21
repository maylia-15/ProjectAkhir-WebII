<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{

    public function run(): void
    {
        $categories = [
            [
                'nama_kategori' => 'Organik',
                'slug' => 'organik',
                'deskripsi' => 'Sampah sisa makanan, daun, dan bahan yang mudah terurai.',
            ],
            [
                'nama_kategori' => 'Anorganik',
                'slug' => 'anorganik',
                'deskripsi' => 'Sampah plastik, kertas, kaca, dan bahan yang sulit terurai.',
            ],
            [
                'nama_kategori' => 'B3 (Berbahaya)',
                'slug' => 'b3',
                'deskripsi' => 'Sampah berbahaya dan beracun seperti baterai, oli bekas, dan bahan kimia.',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}