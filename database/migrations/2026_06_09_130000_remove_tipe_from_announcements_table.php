<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Hapus kolom tipe dari tabel announcements.
     * Sesuai revisi konsep UI: fitur Kelola Pengumuman admin tidak ada input Tipe.
     */
    public function up(): void
    {
        Schema::table('announcements', function (Blueprint $table) {
            $table->dropColumn('tipe');
        });
    }

    public function down(): void
    {
        Schema::table('announcements', function (Blueprint $table) {
            $table->enum('tipe', ['jadwal_kerja_bakti', 'jadwal_truk_sampah', 'himbauan'])
                ->default('himbauan')
                ->after('judul');
        });
    }
};