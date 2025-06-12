<?php

namespace App\Filament\Resources\DetailReservasiResource\Pages;

use App\Filament\Resources\DetailReservasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDetailReservasi extends EditRecord
{
    protected static string $resource = DetailReservasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
