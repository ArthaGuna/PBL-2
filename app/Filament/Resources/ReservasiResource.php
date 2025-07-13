<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReservasiResource\Pages;
use App\Models\Reservasi;
use Filament\Forms\Form;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class ReservasiResource extends Resource
{
    protected static ?string $model = Reservasi::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function getNavigationLabel(): string
    {
        return 'Reservasi';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Manajemen Reservasi';
    }

    public static function getNavigationSort(): ?int
    {
        return 10;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Informasi Reservasi')
                ->description('Detail lengkap dari pemesanan layanan yang dilakukan oleh pengunjung.')
                ->schema([
                    Grid::make(2)
                        ->schema([
                            Group::make()->schema([
                                TextInput::make('kode_booking')
                                    ->label('Kode Booking')
                                    ->disabled(),

                                TextInput::make('nama_pengunjung')
                                    ->label('Nama Pengunjung')
                                    ->disabled(),

                                Select::make('layanan_id')
                                    ->label('Layanan')
                                    ->relationship('layanan', 'nama_layanan')
                                    ->disabled(),

                                DatePicker::make('tanggal_kunjungan')
                                    ->label('Tanggal Kunjungan')
                                    ->disabled(),

                                TimePicker::make('waktu_kunjungan')
                                    ->label('Waktu Kunjungan')
                                    ->disabled()
                                    ->formatStateUsing(fn($state) => $state ? Carbon::parse($state)->format('H:i') : '-'),

                                TextInput::make('waktu_selesai')
                                    ->label('Waktu Selesai')
                                    ->disabled()
                                    ->formatStateUsing(fn($state) => $state ? Carbon::parse($state)->format('H:i') : '-'),
                            ])->columnSpan(1),

                            Group::make()->schema([
                                TextInput::make('jumlah_pengunjung')
                                    ->label('Jumlah Pengunjung')
                                    ->numeric()
                                    ->disabled(),

                                TextInput::make('total_harga')
                                    ->label('Total Harga')
                                    ->numeric()
                                    ->prefix('Rp ')
                                    ->disabled(),

                                TextInput::make('total_bayar')
                                    ->label('Total Bayar')
                                    ->numeric()
                                    ->prefix('Rp ')
                                    ->disabled(),

                                Select::make('status_pembayaran')
                                    ->label('Status Pembayaran')
                                    ->options([
                                        'pending' => 'Pending',
                                        'success' => 'Success',
                                        'failed' => 'Failed',
                                        'cancelled' => 'Cancelled',
                                    ])
                                    ->disabled(),
                            ])->columnSpan(1),
                        ]),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('kode_booking')->label('Kode Booking')->searchable(),
            TextColumn::make('nama_pengunjung')->label('Nama')->searchable(),
            TextColumn::make('layanan.nama_layanan')->label('Layanan'),
            TextColumn::make('tanggal_kunjungan')->label('Tanggal')->date(),
            TextColumn::make('waktu_kunjungan')
                ->label('Waktu Kunjungan')
                ->formatStateUsing(fn($state) => Carbon::parse($state)->format('H:i')),
            TextColumn::make('waktu_selesai')
                ->label('Waktu Selesai')
                ->formatStateUsing(fn($state) => $state ? Carbon::parse($state)->format('H:i') : '-'),
            TextColumn::make('jumlah_pengunjung')->label('Jumlah'),
            TextColumn::make('total_bayar')->label('Total Bayar')->money('IDR'),
            TextColumn::make('status_pembayaran')
                ->label('Status')
                ->badge()
                ->color(fn(string $state): string => match ($state) {
                    'pending' => 'primary',
                    'success' => 'success',
                    'failed', 'cancelled' => 'danger',
                    default => 'gray',
                }),
        ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('restoreStok')
                    ->label('Restore Stok')
                    ->color('warning')
                    ->icon('heroicon-o-arrow-path')
                    ->requiresConfirmation()
                    ->visible(fn($record) => $record->stok_dikurangi)
                    ->action(function ($record) {
                        $record->restoreStokLayanan();
                        \Filament\Notifications\Notification::make()
                            ->title("Stok dikembalikan untuk {$record->kode_booking}")
                            ->success()
                            ->send();
                    }),
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
            'index' => Pages\ListReservasis::route('/'),
            'create' => Pages\CreateReservasi::route('/create'),
            'edit' => Pages\EditReservasi::route('/{record}/edit'),
        ];
    }
}
