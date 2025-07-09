<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Informasi extends Model
{
    use HasFactory;

    protected $table = 'informasis';

    // Kolom yang dapat diisi massal (fillable)
    protected $fillable = [
        'judul',
        'slug',
        'jam_buka',
        'logo',
        'gambar_utama',
        'tentang_kami',
        'latitude',
        'longitude',
        'maps_url',
    ];

    // Tambahkan atribut virtual 'maps_embed_url' ke output model
    protected $appends = ['maps_embed_url'];

    /**
     * Accessor: Membuat atribut virtual 'maps_embed_url'
     * yang bisa diakses seperti properti biasa ($informasi->maps_embed_url)
     */
    public function getMapsEmbedUrlAttribute()
    {
        // Jika koordinat tidak lengkap, kembalikan null
        if (!$this->latitude || !$this->longitude) {
            return null;
        }

        // Kembalikan link Google Maps Embed sesuai format iframe
        return "https://www.google.com/maps?q={$this->latitude},{$this->longitude}&output=embed";
    }

    /**
     * Boot method: dijalankan otomatis ketika model disimpan
     * Digunakan untuk generate slug dan maps_url
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($informasi) {
            // Generate slug jika belum ada dan judul tersedia
            if (empty($informasi->slug) && !empty($informasi->judul)) {
                $informasi->slug = Str::slug($informasi->judul);

                // Cek agar slug tetap unik
                $originalSlug = $informasi->slug;
                $count = 1;
                while (static::where('slug', $informasi->slug)->where('id', '<>', $informasi->id)->exists()) {
                    $informasi->slug = $originalSlug . '-' . $count++;
                }
            }

            // Buat maps_url dari latitude dan longitude jika tersedia
            if ($informasi->latitude && $informasi->longitude) {
                $informasi->maps_url = "https://www.google.com/maps?q={$informasi->latitude},{$informasi->longitude}";
            }
        });
    }
}
