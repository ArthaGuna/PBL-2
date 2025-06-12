<?php

namespace App\Filament\Resources\DetailReservasiResource\Pages;

use App\Filament\Resources\DetailReservasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDetailReservasis extends ListRecords
{
    protected static string $resource = DetailReservasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
