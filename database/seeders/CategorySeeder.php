<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
    Category::create(['nama_kategori' => 'Organik']);
    Category::create(['nama_kategori' => 'Anorganik']);
    Category::create(['nama_kategori' => 'B3 (Bahan Berbahaya & Beracun']);
    }
}
