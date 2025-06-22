<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InformasiResource\Pages;
use App\Models\Informasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

use Dotswan\MapPicker\Fields\Map as FieldsMap;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\MarkdownEditor;

class InformasiResource extends Resource
{
    protected static ?string $model = Informasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';

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
                    ->description('Masukkan informasi umum mengenai tempat wisata.')
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

                        TextInput::make('jam_buka')
                            ->label('Jam Buka')
                            ->placeholder('08.00 - 18.00')
                            ->maxLength(255),

                    ])->columns(1),

                Section::make('Konten')
                    ->description('Unggah logo dan gambar utama, serta deskripsikan tentang tempat ini.')
                    ->schema([
                        FileUpload::make('logo')
                            ->label('Logo')
                            ->image()
                            ->directory('informasi-images')
                            ->preserveFilenames()
                            ->imageEditor()
                            ->maxSize(2048)
                            ->columnSpanFull(),

                        FileUpload::make('gambar_utama')
                            ->label('Gambar Utama')
                            ->image()
                            ->directory('informasi-images')
                            ->preserveFilenames()
                            ->imageEditor()
                            ->maxSize(2048)
                            ->columnSpanFull(),

                        MarkdownEditor::make('tentang_kami')
                            ->label('Tentang Kami')
                            ->required(),
                    ])->columns(1),

                Section::make('Harga Tiket')
                    ->description('Tambahkan kategori dan harga tiket yang berlaku.')
                    ->schema([
                        Repeater::make('tiket')
                            ->relationship()
                            ->label('Daftar Harga')
                            ->schema([
                                TextInput::make('kategori')->label('Kategori')->required(),
                                TextInput::make('harga')->label('Harga (Rp)')->numeric()->required(),
                            ])
                            ->defaultItems(1)
                            ->addActionLabel('Tambah Kategori')
                            ->columns(2),
                    ]),

                Section::make('Lokasi')
                    ->description('Tentukan lokasi tempat wisata dengan memanfaatkan peta.')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('latitude')
                                ->label('Latitude')
                                ->required()
                                ->readOnly(),

                            TextInput::make('longitude')
                                ->label('Longitude')
                                ->required()
                                ->readOnly()

                        ]),
                        TextInput::make('maps_url')
                            ->label('Link Google Maps')
                            ->readOnly()
                            ->helperText('Otomatis diisi dari lokasi yang dipilih'),

                        FieldsMap::make('lokasi')
                            ->label('Pilih Lokasi')
                            ->columnSpanFull()
                            ->defaultLocation(-8.499825, 115.117718) // Yeh Panes Penatahan
                            ->draggable(true)
                            ->showMarker(true)
                            ->zoom(15)
                            ->extraStyles([
                                'min-height: 60vh',
                            ])
                            ->afterStateUpdated(function ($set, ?array $state) {
                                if ($state) {
                                    $set('latitude', $state['lat']);
                                    $set('longitude', $state['lng']);
                                    $set('maps_url', 'https://www.google.com/maps?q=' . $state['lat'] . ',' . $state['lng']);
                                }
                            })
                            ->afterStateHydrated(function ($state, $record, $set) {
                                if ($record) {
                                    $set('lokasi', [
                                        'lat' => $record->latitude,
                                        'lng' => $record->longitude,
                                    ]);
                                } else {
                                    // Default location jika tidak ada data (saat create)
                                    $set('latitude', -8.499825);
                                    $set('longitude', 115.117718);
                                    $set('maps_url', 'https://www.google.com/maps?q=-8.499825,115.117718');
                                    $set('lokasi', [
                                        'lat' => -8.499825,
                                        'lng' => 115.117718,
                                    ]);
                                }
                            }),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul')->searchable(),
                TextColumn::make('jam_buka')->label('Jam Buka'),
                TextColumn::make('created_at')->label('Dibuat Pada')->dateTime()->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
