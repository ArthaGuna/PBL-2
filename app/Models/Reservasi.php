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
        'layanan_id',
        'kode_booking',
        'nama_pengunjung',
        'tanggal_kunjungan',
        'waktu_kunjungan',
        'jumlah_pengunjung',
        'total_harga',
        'diskon',
        'total_bayar',
        'promo_id',
        'status_pembayaran',
        'stok_dikurangi',
        'midtrans_transaction_id',
        'midtrans_payment_type',
        'midtrans_transaction_status',
        'bukti_pembayaran',
    ];

    protected $casts = [
        'tanggal_kunjungan' => 'date',
        'stok_dikurangi' => 'boolean',
    ];

    public function kurangiStokLayanan(): void
    {
        if (!$this->stok_dikurangi && $this->layanan) {
            $this->layanan->kurangiStok(1);
            $this->stok_dikurangi = true;
            $this->save();
        }
    }

    public function restoreStokLayanan(): void
    {
        if ($this->stok_dikurangi && $this->layanan) {
            $this->layanan->tambahStok(1);
            $this->stok_dikurangi = false;
            $this->save();
        }
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function promo(): BelongsTo
    {
        return $this->belongsTo(Promo::class);
    }

    public function layanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class);
    }

    public function detailReservasis(): HasMany
    {
        return $this->hasMany(DetailReservasi::class, 'reservasi_id');
    }
}
