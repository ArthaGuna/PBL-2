<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GaleriVideoResource\Pages;
use App\Models\GaleriVideo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;

class GaleriVideoResource extends Resource
{
    protected static ?string $model = GaleriVideo::class;

    public static function getNavigationLabel(): string
    {
        return 'Galeri Video';
    }

    protected static ?string $navigationIcon = 'heroicon-o-video-camera';

    public static function getNavigationGroup(): ?string
    {
        return 'Manajemen Konten';
    }

    public static function getNavigationSort(): ?int
    {
        return 20;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('judul')
                    ->label('Judul Video')
                    ->required()
                    ->maxLength(255),

                Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->rows(3),

                Select::make('jenis')
                    ->label('Tipe Video')
                    ->options([
                        'upload' => 'Upload',
                        'embed' => 'Embed (YouTube)',
                    ])
                    ->required()
                    ->live(),

                FileUpload::make('path_video')
                    ->label('Upload Video (.mp4)')
                    ->visible(fn($get) => $get('jenis') === 'upload')
                    ->directory('videos')
                    ->disk('public')
                    ->preserveFilenames()
                    ->acceptedFileTypes(['video/mp4']),

                TextInput::make('url_video')
                    ->label('URL Video (YouTube)')
                    ->visible(fn($get) => $get('jenis') === 'embed')
                    ->url(),

                FileUpload::make('thumbnail')
                    ->label('Thumbnail (opsional)')
                    ->image()
                    ->directory('thumbnails')
                    ->disk('public'),

                TextInput::make('kategori')
                    ->label('Kategori'),

                Toggle::make('is_featured')
                    ->label('Tampilkan di Beranda'),

                TextInput::make('urutan')
                    ->label('Urutan')
                    ->numeric(),

                Toggle::make('status')
                    ->label('Tampilkan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul')->searchable(),
                Tables\Columns\TextColumn::make('jenis'),
                Tables\Columns\IconColumn::make('is_featured')->boolean(),
                Tables\Columns\IconColumn::make('status')->boolean(),
            ])
            ->defaultSort('urutan')
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
            'index' => Pages\ListGaleriVideos::route('/'),
            'create' => Pages\CreateGaleriVideo::route('/create'),
            'edit' => Pages\EditGaleriVideo::route('/{record}/edit'),
        ];
    }
}
