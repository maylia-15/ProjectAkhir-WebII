<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Alamat untuk model User
use Illuminate\Support\Facades\Hash; // Alamat untuk fitur Hash Password

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun untuk Pengurus Perumahan (Admin)
        User::create([
            'name' => 'Admin Komplek',
            'email' => 'admin@bisa.com',
            'password' => Hash::make('password123'),
            'peran' => 'admin',
        ]);

        // 2. Akun untuk Warga Komplek (User)
        User::create([
            'name' => 'Ameng',
            'email' => 'warga@bisa.com',
            'password' => Hash::make('password123'),
            'peran' => 'warga',
        ]);
    }
}