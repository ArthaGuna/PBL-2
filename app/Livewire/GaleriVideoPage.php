<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\GaleriVideo;

class GaleriVideoPage extends Component
{
    public $videoUtama;
    public $rekomendasi = [];

    public function mount()
    {
        $this->setVideoUtama();
    }

    public function setVideoUtama($id = null)
    {
        $this->videoUtama = $id
            ? GaleriVideo::findOrFail($id)
            : GaleriVideo::where('status', true)
            ->orderByDesc('is_featured')
            ->orderBy('urutan')
            ->first();

        $this->rekomendasi = GaleriVideo::where('status', true)
            ->where('id', '!=', $this->videoUtama->id)
            ->orderByDesc('is_featured')
            ->orderBy('urutan')
            ->take(4)
            ->get();
    }

    public function pilihVideo($id)
    {
        // Blur akan muncul otomatis lewat wire:loading
        $this->setVideoUtama($id);
    }

    public function render()
    {
        return view('livewire.galeri-video-page');
    }
}
