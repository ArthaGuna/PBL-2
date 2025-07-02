<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Layanan extends Model
{
    use HasFactory;

    protected $table = 'layanans';

    protected $fillable = [
        'nama_layanan',
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
            $layanan->stok = $layanan->jumlah;
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

    public function tiket()
    {
        return $this->hasOne(InformasiTiket::class);
    }

    public function reservasis(): HasMany
    {
        return $this->hasMany(Reservasi::class);
    }

    public function detailReservasis(): HasMany
    {
        return $this->hasMany(DetailReservasi::class, 'layanan_id');
    }
}
