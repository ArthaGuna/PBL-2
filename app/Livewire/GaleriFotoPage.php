<?php

namespace App\Livewire;

use App\Models\GaleriFoto;
use Livewire\Component;

class GaleriFotoPage extends Component
{
    public $kategoriTerpilih = 'Semua';
    public $fotoTerpilih = null;
    public $showModal = false;

    public function pilihKategori($kategori)
    {
        $this->kategoriTerpilih = $kategori;
    }

    public function tampilkanFoto($fotoId)
    {
        $this->fotoTerpilih = GaleriFoto::find($fotoId);
        $this->showModal = true;
    }

    public function tutupModal()
    {
        $this->showModal = false;
        $this->fotoTerpilih = null;
    }

    public function fotoSebelumnya()
    {
        $fotos = $this->getFilteredFotos();
        $currentIndex = $fotos->search(function ($item) {
            return $item->id === $this->fotoTerpilih->id;
        });
        
        $prevIndex = ($currentIndex - 1 + $fotos->count()) % $fotos->count();
        $this->fotoTerpilih = $fotos[$prevIndex];
    }

    public function fotoBerikutnya()
    {
        $fotos = $this->getFilteredFotos();
        $currentIndex = $fotos->search(function ($item) {
            return $item->id === $this->fotoTerpilih->id;
        });
        
        $nextIndex = ($currentIndex + 1) % $fotos->count();
        $this->fotoTerpilih = $fotos[$nextIndex];
    }

    protected function getFilteredFotos()
    {
        return GaleriFoto::query()
            ->when($this->kategoriTerpilih !== 'Semua', function ($query) {
                $query->where('kategori', $this->kategoriTerpilih);
            })
            ->where('status', true)
            ->orderBy('urutan')
            ->get();
    }

    public function render()
    {
        $categories = [
            'Semua' => 'Semua',
            'kolam-air-panas' => 'Kolam Air Panas',
            'jacuzzi' => 'Jacuzzi',
            'ho-river' => 'Ho River',
            'gazebo' => 'Gazebo',
            'kantin' => 'Kantin',
            // 'penginapan' => 'Penginapan',
        ];

        $fotos = $this->getFilteredFotos();

        return view('livewire.galeri-foto-page', [
            'fotos' => $fotos,
            'categories' => $categories,
        ]);
    }
}