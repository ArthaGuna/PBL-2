<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReservasiResource\Pages;
use App\Models\Reservasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Carbon\Carbon;

class ReservasiResource extends Resource
{
    protected static ?string $model = Reservasi::class;

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

    protected static ?string $navigationGroup = 'Reservasi';

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('kode_booking')->disabled(),
            TextInput::make('nama_pengunjung')->required()->disabled(),
            Select::make('layanan_id')
                ->relationship('layanan', 'nama_layanan')
                ->disabled(),
            DatePicker::make('tanggal_kunjungan')->disabled(),
            TimePicker::make('waktu_kunjungan')
                ->label('Waktu')
                ->formatStateUsing(fn($state) => Carbon::parse($state)->format('H:i')),
            TextInput::make('waktu_selesai')
                ->label('Waktu Selesai')
                ->disabled()
                ->formatStateUsing(fn($state) => $state ? Carbon::parse($state)->format('H:i') : '-'),
            TextInput::make('jumlah_pengunjung')->numeric()->disabled(),
            TextInput::make('total_harga')->numeric()->disabled(),
            TextInput::make('total_bayar')->numeric()->disabled(),
            Select::make('status_pembayaran')
                ->options([
                    'pending' => 'Pending',
                    'success' => 'Success',
                    'failed' => 'Failed',
                    'cancelled' => 'Cancelled',
                ])->disabled(),
            // Toggle::make('stok_dikurangi')->disabled(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_booking')->searchable(),
                TextColumn::make('nama_pengunjung')->searchable(),
                TextColumn::make('layanan.nama_layanan')->label('Layanan'),
                TextColumn::make('tanggal_kunjungan')->date(),
                TextColumn::make('waktu_kunjungan')
                    ->label('Waktu')
                    ->formatStateUsing(fn($state) => Carbon::parse($state)->format('H:i')),
                TextColumn::make('waktu_selesai')
                    ->label('Waktu Selesai')
                    ->formatStateUsing(fn($state) => $state ? Carbon::parse($state)->format('H:i') : '-'),
                TextColumn::make('jumlah_pengunjung'),
                TextColumn::make('total_bayar')->money('IDR'),
                TextColumn::make('status_pembayaran')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'primary',
                        'success' => 'success',
                        'failed', 'cancelled' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->filters([]) // bisa tambahkan filter jika perlu
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),

                Tables\Actions\Action::make('restoreStok')
                    ->label('Restore Stok')
                    ->color('warning')
                    ->icon('heroicon-o-arrow-path')
                    ->requiresConfirmation()
                    ->visible(fn($record) => $record->stok_dikurangi) // hanya muncul kalau stok dikurangi
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
        return [
            // bisa ditambahkan relasi jika diperlukan
        ];
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
