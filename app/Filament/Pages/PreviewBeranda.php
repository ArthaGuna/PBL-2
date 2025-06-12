<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class PreviewBeranda extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-eye';

    protected static string $view = 'filament.pages.preview-beranda';

    protected static ?string $navigationLabel = 'Preview Beranda';

    protected static ?int $navigationSort = 50;

    protected static ?string $navigationGroup = 'Pengaturan';

    protected static bool $shouldRegisterNavigation = true;

    protected function getHeaderWidgets(): array
    {
        return [];
    }
}
