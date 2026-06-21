<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->string('judul');

            $table->enum('tipe', ['jadwal_kerja_bakti', 'jadwal_truk_sampah', 'himbauan'])
                ->default('himbauan');

            $table->text('isi');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
