<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'judul',
        'deskripsi',
        'foto',
        'lokasi',
        'status'
    ];

    // Kebalikan One-to-Many: Laporan ini milik dari User siapa
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Kebalikan One-to-Many: Laporan ini masuk kategori apa
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Relasi Many-to-Many: Satu laporan bisa punya banyak tag penanda
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'report_tag');
    }
}