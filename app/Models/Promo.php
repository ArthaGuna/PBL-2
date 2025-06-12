<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Promo extends Model
{
    use HasFactory;

    protected $table = 'promos';

    protected $fillable = [
        'kode_promo',
        'judul',
        'deskripsi',
        'jenis_diskon',
        'nilai_diskon',
        'tanggal_mulai',
        'tanggal_berakhir',
        'minimal_pembelian',
        'maksimal_diskon',
        'kuota',
        'status',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_berakhir' => 'date',
        'status' => 'boolean',
    ];

    public function reservasis(): HasMany
    {
        return $this->hasMany(Reservasi::class, 'promo_id');
    }
}
