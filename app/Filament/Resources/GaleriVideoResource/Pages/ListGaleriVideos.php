<?php

namespace App\Filament\Resources\GaleriVideoResource\Pages;

use App\Filament\Resources\GaleriVideoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGaleriVideos extends ListRecords
{
    protected static string $resource = GaleriVideoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
