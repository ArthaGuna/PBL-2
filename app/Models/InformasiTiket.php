<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiTiket extends Model
{
    use HasFactory;

    protected $fillable = [
        'informasi_id',
        'kategori',
        'harga',
        'maks_pengunjung',
    ];

    public function layanan()
    {
        return $this->belongsTo(Informasi::class);
    }
}
