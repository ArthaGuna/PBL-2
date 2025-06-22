<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChatbotResource\Pages;
use App\Filament\Resources\ChatbotResource\RelationManagers;
use App\Models\Chatbot;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use function Laravel\Prompts\textarea;

class ChatbotResource extends Resource
{
    protected static ?string $model = Chatbot::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    protected static ?string $navigationLabel = 'ChatBot';

    protected static ?int $navigationSort = 30;

    protected static ?string $navigationGroup = 'Pengaturan';

    protected static ?string $title = 'Setelan';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Data Chatbot')
                ->description('Tambahkan kata kunci dan jawaban yang akan digunakan oleh chatbot untuk merespons pertanyaan pengunjung.')
                ->schema([
                    TagsInput::make('keyword')
                        ->label('Kata Kunci')
                        ->placeholder('Contoh: harga, tiket, biaya')
                        ->helperText('Masukkan beberapa kata kunci yang mungkin ditanyakan oleh pengguna.')
                        ->required(),

                    Textarea::make('answer')
                        ->label('Jawaban')
                        ->placeholder('Masukkan jawaban yang akan ditampilkan chatbot...')
                        ->rows(5)
                        ->required(),
                ])
        ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('keyword')
                    ->label('Keyword')
                    ->wrap(),
                TextColumn::make('answer')
                    ->label('Jawaban')
                    ->limit(50)
                    ->wrap(),
            ])
            ->defaultSort('id', 'desc')
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChatbots::route('/'),
            'create' => Pages\CreateChatbot::route('/create'),
            'edit' => Pages\EditChatbot::route('/{record}/edit'),
        ];
    }
}
