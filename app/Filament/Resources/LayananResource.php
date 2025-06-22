<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LayananResource\Pages;
use App\Models\Layanan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;

class LayananResource extends Resource
{
    protected static ?string $model = Layanan::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function getNavigationLabel(): string
    {
        return 'Layanan';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Manajemen Layanan';
    }

    public static function getNavigationSort(): ?int
    {
        return 10;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Layanan')
                    ->description('Lengkapi detail layanan yang ditawarkan kepada pengunjung, termasuk nama, deskripsi, harga, durasi, dan status layanan.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Group::make()
                                    ->schema([
                                        TextInput::make('nama_layanan')
                                            ->label('Nama Layanan')
                                            ->required()
                                            ->maxLength(255),

                                        Textarea::make('deskripsi')
                                            ->label('Deskripsi')
                                            ->required()
                                            ->rows(6)
                                            ->maxLength(65535),

                                        Toggle::make('status')
                                            ->label('Aktifkan layanan')
                                            ->default(true),
                                    ])
                                    ->columnSpan(1),

                                Group::make()
                                    ->schema([
                                        FileUpload::make('gambar')
                                            ->label('Gambar Layanan')
                                            ->image()
                                            ->imagePreviewHeight('250')
                                            ->directory('layanan-images')
                                            ->required(),

                                        TextInput::make('harga')
                                            ->label('Harga')
                                            ->required()
                                            ->prefix('Rp')
                                            ->formatStateUsing(fn($state) => $state ? 'Rp ' . number_format($state, 0, ',', '.') : null)
                                            ->dehydrateStateUsing(fn($state) => (int) str_replace(['Rp', '.', ' '], '', $state))
                                            ->numeric(),

                                        TextInput::make('durasi')
                                            ->label('Durasi (menit)')
                                            ->numeric()
                                            ->required(),

                                    ])
                                    ->columnSpan(1),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('gambar')
                    ->label('Gambar'),

                TextColumn::make('nama_layanan')
                    ->label('Nama Layanan')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('harga')
                    ->label('Harga')
                    ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.')),

                TextColumn::make('durasi')
                    ->label('Durasi (menit)'),

                IconColumn::make('status')
                    ->label('Status')
                    ->boolean(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLayanans::route('/'),
            'create' => Pages\CreateLayanan::route('/create'),
            'edit' => Pages\EditLayanan::route('/{record}/edit'),
        ];
    }
}
