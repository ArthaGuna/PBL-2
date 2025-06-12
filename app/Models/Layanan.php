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
        'harga',
        'durasi',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function detailReservasis(): HasMany
    {
        return $this->hasMany(DetailReservasi::class, 'layanan_id');
    }
}
