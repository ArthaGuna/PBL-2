<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriVideo extends Model
{
    use HasFactory;

    protected $table = 'galeri_videos';

    protected $fillable = [
        'judul',
        'deskripsi',
        'jenis',
        'path_video',
        'url_video',
        'thumbnail',
        'kategori',
        'is_featured',
        'urutan',
        'status',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'status' => 'boolean',
    ];

    public function getEmbedUrl()
    {
        if (!$this->url_video) {
            return null;
        }

        $url = $this->url_video;

        if (str_contains($url, 'youtu.be')) {
            $videoId = explode('/', parse_url($url, PHP_URL_PATH))[1] ?? null;
        } elseif (str_contains($url, 'watch?v=')) {
            parse_str(parse_url($url, PHP_URL_QUERY), $params);
            $videoId = $params['v'] ?? null;
        } elseif (str_contains($url, 'embed/')) {
            return $url;
        } else {
            return null;
        }

        return $videoId ? 'https://www.youtube.com/embed/' . $videoId : null;
    }
}
