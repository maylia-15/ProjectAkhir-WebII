<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Report;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    public function run(): void
    {
        $wargaIds = User::where('role', 'warga')->pluck('id');
        $categoryIds = Category::pluck('id');
        $tagIds = Tag::pluck('id');

        if ($wargaIds->isEmpty() || $categoryIds->isEmpty()) {
            $this->command->warn('UserSeeder/CategorySeeder belum dijalankan, ReportSeeder dilewati.');
            return;
        }

        $statuses = ['menunggu', 'menunggu', 'diproses', 'diproses', 'selesai', 'selesai', 'ditolak'];

        foreach ($statuses as $status) {
            Report::factory()
                ->state([
                    'user_id' => $wargaIds->random(),
                    'category_id' => $categoryIds->random(),
                    'status' => $status,
                ])
                ->create()
                ->tags()
                ->attach(
                    $tagIds->random(rand(0, 2))->all() 
                );
        }

        Report::factory()
            ->count(8)
            ->create()
            ->each(function (Report $report) use ($tagIds) {
                $report->tags()->attach(
                    $tagIds->random(rand(0, 2))->all()
                );
            });
    }
}