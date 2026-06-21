<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            'Bau Menyengat',
            'Menumpuk',
            'Berserakan',
        ];

        foreach ($tags as $namaTag) {
            Tag::updateOrCreate(
                ['nama_tag' => $namaTag],
                ['nama_tag' => $namaTag]
            );
        }
    }
}