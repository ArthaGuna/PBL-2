<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GaleriFotoResource\Pages;
use App\Filament\Resources\GaleriFotoResource\RelationManagers;
use App\Models\GaleriFoto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
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
                Forms\Components\Section::make('Informasi Foto')
                    ->schema([
                        Forms\Components\TextInput::make('judul')
                            ->required()
                            ->maxLength(255),

                        // Forms\Components\TextInput::make('slug')
                        //     ->maxLength(255)
                        //     ->disabled()
                        //     ->unique(ignoreRecord: true),

                        Forms\Components\Select::make('kategori')
                            ->options([
                                'kolam-air-panas' => 'Kolam Air Panas',
                                'jacuzzi' => 'Jacuzzi',
                                'ho-river' => 'Ho River',
                                'gazebo' => 'Gazebo',
                                'parkir' => 'Lahan Parkir',
                                'kantin' => 'Kantin'

                            ])
                            ->required(),

                        Forms\Components\Textarea::make('deskripsi')
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Foto')
                    ->schema([
                        Forms\Components\FileUpload::make('path_foto')
                            ->label('Foto')
                            ->image()
                            ->directory('galeri-foto')
                            ->required()
                            ->imageEditor()
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Pengaturan')
                    ->schema([
                        Forms\Components\Toggle::make('is_featured')
                            ->label('Featured')
                            ->default(false),

                        Forms\Components\Toggle::make('status')
                            ->label('Aktif')
                            ->default(true),

                        Forms\Components\TextInput::make('urutan')
                            ->numeric()
                            ->default(0),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('path_foto')
                    ->label('Foto')
                    ->disk('public'),

                Tables\Columns\TextColumn::make('judul')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('kategori')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'kolam-air-panas' => 'info',
                        'jacuzzi' => 'success',
                        'ho-river' => 'warning',
                        'restaurant' => 'danger',
                        'penginapan' => 'gray',
                        default => 'secondary',
                    }),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean(),

                Tables\Columns\TextColumn::make('urutan')
                    ->sortable(),

                Tables\Columns\IconColumn::make('status')
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
