<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Informasi extends Model
{
    use HasFactory;

    protected $table = 'informasis';

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

    /**
     * Boot method to automatically generate slug on creating or updating
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($informasi) {
            if (empty($informasi->slug) && !empty($informasi->judul)) {
                $informasi->slug = Str::slug($informasi->judul);

                // Jika ingin memastikan slug unik, tambahkan pengecekan di sini (optional)
                $originalSlug = $informasi->slug;
                $count = 1;

                while (static::where('slug', $informasi->slug)->where('id', '<>', $informasi->id)->exists()) {
                    $informasi->slug = $originalSlug . '-' . $count++;
                }

                if ($informasi->latitude && $informasi->longitude) {
                    $informasi->maps_url = "https://www.google.com/maps?q={$informasi->latitude},{$informasi->longitude}";
                }
            }
        });
    }

    public function tiket()
    {
        return $this->hasMany(InformasiTiket::class);
    }
}
