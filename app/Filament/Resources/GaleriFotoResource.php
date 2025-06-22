<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GaleriFotoResource\Pages;
use App\Filament\Resources\GaleriFotoResource\RelationManagers;
use App\Models\GaleriFoto;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class GaleriFotoResource extends Resource
{
    protected static ?string $model = GaleriFoto::class;

    public static function getNavigationLabel(): string
    {
        return 'Galeri Foto';
    }

    protected static ?string $navigationIcon = 'heroicon-o-camera';

    public static function getNavigationGroup(): ?string
    {
        return 'Manajemen Konten';
    }

    public static function getNavigationSort(): ?int
    {
        return 10;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Foto')
                    ->description('Masukkan detail foto seperti judul, kategori, dan deskripsi singkat.')
                    ->schema([
                        TextInput::make('judul')
                            ->required()
                            ->maxLength(255),

                        // TextInput::make('slug')
                        //     ->maxLength(255)
                        //     ->disabled()
                        //     ->unique(ignoreRecord: true),

                        Select::make('kategori')
                            ->options([
                                'kolam-air-panas' => 'Kolam Air Panas',
                                'jacuzzi' => 'Jacuzzi',
                                'ho-river' => 'Ho River',
                                'gazebo' => 'Gazebo',
                                'parkir' => 'Lahan Parkir',
                                'kantin' => 'Kantin'

                            ])
                            ->required(),

                        Textarea::make('deskripsi')
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Foto')
                    ->description('Unggah foto yang akan ditampilkan di galeri.')
                    ->schema([
                        FileUpload::make('path_foto')
                            ->label('Foto')
                            ->image()
                            ->directory('galeri-foto')
                            ->required()
                            ->imageEditor()
                            ->columnSpanFull(),
                    ]),

                Section::make('Pengaturan')
                    ->description('Tentukan urutan dan status tampilan foto.')
                    ->schema([
                        Toggle::make('is_featured')
                            ->label('Tampilkan')
                            ->default(false),

                        Toggle::make('status')
                            ->label('Aktif')
                            ->default(true),

                        TextInput::make('urutan')
                            ->numeric()
                            ->default(0),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('path_foto')
                    ->label('Foto')
                    ->disk('public'),

                TextColumn::make('judul')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('kategori')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'kolam-air-panas' => 'info',
                        'jacuzzi' => 'success',
                        'ho-river' => 'warning',
                        'restaurant' => 'danger',
                        'penginapan' => 'gray',
                        default => 'secondary',
                    }),

                IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean(),

                TextColumn::make('urutan')
                    ->sortable(),

                IconColumn::make('status')
                    ->label('Aktif')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori')
                    ->options([
                        'kolam-air-panas' => 'Kolam Air Panas',
                        'jacuzzi' => 'Jacuzzi',
                        'ho-river' => 'Ho River',
                        'restaurant' => 'Restaurant',
                        'penginapan' => 'Penginapan',
                    ]),

                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Featured'),

                Tables\Filters\TernaryFilter::make('status')
                    ->label('Aktif'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('urutan', 'asc');
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
            'index' => Pages\ListGaleriFotos::route('/'),
            'create' => Pages\CreateGaleriFoto::route('/create'),
            'edit' => Pages\EditGaleriFoto::route('/{record}/edit'),
        ];
    }
}
