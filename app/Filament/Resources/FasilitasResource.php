<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FasilitasResource\Pages;
use App\Models\Fasilitas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;

class FasilitasResource extends Resource
{
    protected static ?string $model = Fasilitas::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    public static function getNavigationLabel(): string
    {
        return 'Fasilitas';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Manajemen Layanan';
    }

    public static function getNavigationSort(): ?int
    {
        return 20;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Data Fasilitas')
                    ->description('Isi informasi lengkap mengenai fasilitas yang tersedia, termasuk nama, deskripsi, status, dan gambar fasilitas yang akan ditampilkan kepada pengunjung.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                // Kolom Kiri
                                Forms\Components\Group::make()
                                    ->schema([
                                        TextInput::make('nama_fasilitas')
                                            ->label('Nama Fasilitas')
                                            ->required()
                                            ->maxLength(255),

                                        Textarea::make('deskripsi')
                                            ->label('Deskripsi')
                                            ->required()
                                            ->rows(6),
                                    ])
                                    ->columnSpan(1),

                                // Kolom Kanan
                                Forms\Components\Group::make()
                                    ->schema([
                                        FileUpload::make('gambar')
                                            ->label('Gambar Fasilitas')
                                            ->image()
                                            ->directory('fasilitas-images')
                                            ->imagePreviewHeight('200')
                                            ->required(),

                                        Toggle::make('is_featured')
                                            ->label('Tampilkan sebagai Fasilitas Unggulan')
                                            ->default(false),

                                        Toggle::make('status')
                                            ->label('Aktifkan Fasilitas')
                                            ->default(true),
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

                TextColumn::make('nama_fasilitas')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                // IconColumn::make('is_featured')
                //     ->label('Unggulan')
                //     ->boolean(),

                IconColumn::make('status')
                    ->label('Status')
                    ->boolean(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListFasilitas::route('/'),
            'create' => Pages\CreateFasilitas::route('/create'),
            'edit' => Pages\EditFasilitas::route('/{record}/edit'),
        ];
    }
}
