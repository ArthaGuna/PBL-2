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
        'deskripsi',
        'gambar_utama',
        'jam_buka',
        'alamat'
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
            }
        });
    }

    public function tiket()
    {
        return $this->hasMany(InformasiTiket::class);
    }
}
