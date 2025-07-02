<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailReservasi extends Model
{
    use HasFactory;

    protected $table = 'detail_reservasis';

    protected $fillable = [
        'reservasi_id',
        'layanan_id',
        'jumlah',
        'harga_satuan',
        'subtotal',
        'mulai',
        'selesai'
    ];

    public function reservasi(): BelongsTo
    {
        return $this->belongsTo(Reservasi::class);
    }

    public function layanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class);
    }
}
