<?php

namespace App\Livewire;

use App\Models\GaleriFoto;
use Livewire\Component;

class GaleriFotoPage extends Component
{
    public $kategoriTerpilih = 'Semua';

    public function pilihKategori($kategori)
    {
        $this->kategoriTerpilih = $kategori;
    }

    public function render()
    {
        $categories = [
            'Semua' => 'Semua',
            'kolam-air-panas' => 'Kolam Air Panas',
            'jacuzzi' => 'Jacuzzi',
            'ho-river' => 'Ho River',
            'restaurant' => 'Restaurant',
            'penginapan' => 'Penginapan',
        ];

        $fotos = GaleriFoto::query()
            ->when($this->kategoriTerpilih !== 'Semua', function ($query) {
                $query->where('kategori', $this->kategoriTerpilih);
            })
            ->where('status', true)
            ->orderBy('urutan')
            ->get();

        return view('livewire.galeri-foto-page', [
            'fotos' => $fotos,
            'categories' => $categories,
        ]);
    }
}
