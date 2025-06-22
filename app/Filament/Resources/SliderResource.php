<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SliderResource\Pages;
use App\Models\Slider;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SliderResource extends Resource
{
    protected static ?string $model = Slider::class;

    public static function getNavigationLabel(): string
    {
        return 'Slider';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Manajemen Konten';
    }

    public static function getNavigationSort(): ?int
    {
        return 30;
    }

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Slider')
                    ->description('Isi informasi utama slider')
                    ->schema([

                        Grid::make(2)
                            ->schema([
                                TextInput::make('judul')
                                    ->label('Judul')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('urutan')
                                    ->numeric()
                                    ->label('Urutan Tampil')
                                    ->default(1),
                            ]),
                        TextInput::make('url_button')
                            ->label('URL Tombol')
                            ->placeholder('Contoh: /layanan atau https://example.com')
                            ->nullable(),
                    ]),

                Section::make('Gambar & Status')
                    ->description('Unggah gambar dan atur status slider')
                    ->schema([
                        FileUpload::make('gambar')
                            ->label('Gambar')
                            ->directory('sliders')
                            ->image()
                            ->imageEditor()
                            ->required(),

                        Toggle::make('status')
                            ->label('Aktifkan slider')
                            ->default(true),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('gambar')->label('Gambar')->circular(),
                TextColumn::make('judul')->label('Judul')->searchable(),
                TextColumn::make('urutan')->sortable()->label('Urutan'),
                IconColumn::make('status')->boolean()->label('Aktif'),
                TextColumn::make('created_at')->dateTime('d M Y')->label('Tanggal Dibuat'),
            ])
            ->defaultSort('urutan')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSliders::route('/'),
            'create' => Pages\CreateSlider::route('/create'),
            'edit' => Pages\EditSlider::route('/{record}/edit'),
        ];
    }
}
