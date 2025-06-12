<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class GaleriFoto extends Model
{
    use HasFactory;

    protected $table = 'galeri_fotos';

    protected $fillable = [
        'judul',
        'deskripsi',
        'path_foto',
        'kategori',
        'is_featured',
        'urutan',
        'status',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'status' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::deleting(function ($galeriFoto) {
            if ($galeriFoto->path_foto && Storage::disk('public')->exists($galeriFoto->path_foto)) {
                Storage::disk('public')->delete($galeriFoto->path_foto);
            }
        });

        static::updating(function ($galeriFoto) {
            if ($galeriFoto->isDirty('path_foto')) {
                $oldFile = $galeriFoto->getOriginal('path_foto');
                if ($oldFile && Storage::disk('public')->exists($oldFile)) {
                    Storage::disk('public')->delete($oldFile);
                }
            }
        });
    }
}
