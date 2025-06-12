<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasis';

    protected $fillable = [
        'user_id',
        'kode_booking',
        'tanggal_kunjungan',
        'waktu_kunjungan',
        'jumlah_pengunjung',
        'total_harga',
        'diskon',
        'total_bayar',
        'promo_id',
        'status_pembayaran',
        'midtrans_transaction_id',
        'midtrans_payment_type',
        'midtrans_transaction_status',
        'bukti_pembayaran',
    ];

    protected $casts = [
        'tanggal_kunjungan' => 'date',
        'waktu_kunjungan' => 'time',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function promo(): BelongsTo
    {
        return $this->belongsTo(Promo::class);
    }

    public function detailReservasis(): HasMany
    {
        return $this->hasMany(DetailReservasi::class, 'reservasi_id');
    }
}
