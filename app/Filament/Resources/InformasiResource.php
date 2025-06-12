<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InformasiResource\Pages;
use App\Models\Informasi;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class InformasiResource extends Resource
{
    protected static ?string $model = Informasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';

    public static function getModelLabel(): string
    {
        return 'Informasi';
    }

    public static function getSlug(): string
    {
        return 'informasi';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Informasi';
    }

    public static function getNavigationLabel(): string
    {
        return 'Informasi';
    }

    public static function getNavigationSort(): ?int
    {
        return 10;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Utama')
                    ->schema([
                        TextInput::make('judul')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                if ($operation === 'edit') return;
                                $set('slug', Str::slug($state));
                            }),

                        TextInput::make('slug')
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->disabled(),

                        FileUpload::make('gambar_utama')
                            ->label('Gambar Utama')
                            ->image()
                            ->directory('informasi-images')
                            ->maxSize(2048)
                            ->getUploadedFileNameForStorageUsing(
                                fn(TemporaryUploadedFile $file): string =>
                                (string) str($file->getClientOriginalName())->prepend('informasi-'),
                            ),
                    ])->columns(1),

                Section::make('Konten')
                    ->schema([
                        TextInput::make('jam_buka')
                            ->label('Jam Buka')
                            ->placeholder('08.00 - 18.00')
                            ->maxLength(255),

                        TextInput::make('alamat')
                            ->label('Alamat')
                            ->maxLength(255),

                        RichEditor::make('deskripsi')
                            ->required(),
                    ])->columns(1),

                Section::make('Harga Tiket')
                    ->schema([
                        Repeater::make('tiket')
                            ->relationship()
                            ->label('Daftar Harga')
                            ->schema([
                                TextInput::make('kategori')
                                    ->label('Kategori')
                                    ->required(),

                                TextInput::make('harga')
                                    ->label('Harga (Rp)')
                                    ->numeric()
                                    ->required(),
                            ])
                            ->defaultItems(1)
                            ->addActionLabel('Tambah Kategori')
                            ->columns(2),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('gambar_utama')->label('Gambar'),
                TextColumn::make('judul')->searchable(),
                TextColumn::make('jam_buka')->label('Jam Buka'),
                TextColumn::make('alamat')->label('Alamat'),
                // TextColumn::make('tiket')
                //     ->label('Harga Tiket')
                //     ->formatStateUsing(function ($record) {
                //         return $record->tiket
                //             ->map(fn($t) => "{$t->kategori}: Rp" . number_format($t->harga, 0, ',', '.'))
                //             ->implode(', ');
                //     })
                //     ->wrap(),
                TextColumn::make('created_at')->label('Dibuat Pada')->dateTime()->sortable(),
            ])
            ->filters([])
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
            'index' => Pages\ListInformasis::route('/'),
            'create' => Pages\CreateInformasi::route('/create'),
            'edit' => Pages\EditInformasi::route('/{record}/edit'),
        ];
    }
}
