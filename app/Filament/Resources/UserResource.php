<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    public static function getNavigationSort(): ?int
    {
        return 20;
    }

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Fieldset::make('Informasi Pengguna')
                    ->schema([


                        TextInput::make('name')
                            ->label('Username')
                            ->required()
                            ->maxLength(255)
                            ->disabled(),

                        TextInput::make('email')
                            ->label('Email')
                            ->required()
                            ->maxLength(255)
                            ->disabled(),

                        TextInput::make('phone')
                            ->label('Nomor Telepon')
                            ->required()
                            ->maxLength(255)
                            ->disabled(),

                        // TextInput::make('alamat')
                        //     ->label('Alamat')
                        //     ->required()
                        //     ->maxLength(255)
                        //     ->disabled(),

                        TextInput::make('role')
                            ->label('Role')
                            ->formatStateUsing(fn(string $state): string => match ($state) {
                                default => $state,
                            })
                            ->disabled(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('email'),
                TextColumn::make('phone'),
                // TextColumn::make('alamat'),
                TextColumn::make('created_at'),

            ])
            ->filters([
                //
            ])
            ->actions([
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
