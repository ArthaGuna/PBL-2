<?php

namespace App\Livewire;

use App\Models\GaleriFoto;
use Livewire\Component;

class FeaturedGaleriCarousell extends Component
{
    public function render()
    {
        $fotos = GaleriFoto::where('is_featured', true)
            ->where('status', true)
            ->orderBy('urutan')
            ->get();

        return view('livewire.featured-galeri-carousell', [
            'fotos' => $fotos
        ]);
    }
}
