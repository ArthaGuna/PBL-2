<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Fasilitas extends Model
{
    use HasFactory;

    protected $table = 'fasilitas';

    protected $fillable = [
        'nama_fasilitas',
        'slug',
        'deskripsi',
        'gambar',
        'is_featured',
        'status',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'status' => 'boolean',
    ];

    protected static function booted()
    {
        static::creating(function ($fasilitas) {
            $fasilitas->slug = Str::slug($fasilitas->nama_fasilitas);
        });

        static::updating(function ($fasilitas) {
            $fasilitas->slug = Str::slug($fasilitas->nama_fasilitas);
        });
    }
}
