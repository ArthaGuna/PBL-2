<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Layanan extends Model
{
    use HasFactory;

    protected $table = 'layanans';

    protected $fillable = [
        'nama_layanan',
        'slug',
        'deskripsi',
        'gambar',
        'jumlah',
        'stok',
        'durasi',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'jumlah' => 'integer',
        'stok' => 'integer',
        'durasi' => 'integer',
    ];

    protected static function booted()
    {
        static::creating(function ($layanan) {
            $layanan->slug = Str::slug($layanan->nama_layanan);
            $layanan->stok = $layanan->jumlah;
        });

        static::updating(function ($layanan) {
            $layanan->slug = Str::slug($layanan->nama_layanan);
        });
    }

    public function kurangiStok(int $jumlah): void
    {
        $this->stok = max(0, $this->stok - $jumlah);
        $this->save();
    }

    public function tambahStok(int $jumlah): void
    {
        $this->stok += $jumlah;
        $this->save();
    }

    public function reservasis(): HasMany
    {
        return $this->hasMany(Reservasi::class);
    }

    public function tiket()
    {
        return $this->hasOne(InformasiTiket::class);
    }
}
