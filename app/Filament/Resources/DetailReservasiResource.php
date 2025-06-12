<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DetailReservasiResource\Pages;
use App\Filament\Resources\DetailReservasiResource\RelationManagers;
use App\Models\DetailReservasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DetailReservasiResource extends Resource
{
    protected static ?string $model = DetailReservasi::class;

    public static function getNavigationLabel(): string
    {
        return 'Detail Reservasi';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Manajemen Reservasi';
    }

    public static function getNavigationSort(): ?int
    {
        return 20; // atur sesuai daftar di atas
    }

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDetailReservasis::route('/'),
            'create' => Pages\CreateDetailReservasi::route('/create'),
            'edit' => Pages\EditDetailReservasi::route('/{record}/edit'),
        ];
    }
}
