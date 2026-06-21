<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@bisa.test'],
            [
                'name' => 'Pak RT Ahmad',
                'email' => 'admin@bisa.test',
                'password' => bcrypt('password'),
                'no_hp' => '081234567890',
                'blok_rumah' => 'Kantor RT',
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'warga@bisa.test'],
            [
                'name' => 'Budi Santoso',
                'email' => 'warga@bisa.test',
                'password' => bcrypt('password'),
                'no_hp' => '081298765432',
                'blok_rumah' => 'Blok A No. 12',
                'role' => 'warga',
                'email_verified_at' => now(),
            ]
        );

        User::factory()
            ->count(13)
            ->warga()
            ->create();
    }
}