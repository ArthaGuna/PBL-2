<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Storage;
use App\Models\Setelan;

class Pengaturan extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static string $view = 'filament.pages.pengaturan';
    protected static ?string $navigationLabel = 'Setelan';
    protected static ?int $navigationSort = 20;
    protected static ?string $navigationGroup = 'Pengaturan';
    protected static ?string $title = 'Setelan';

    public $tiktok, $facebook, $instagram, $linkedin, $youtube, $number, $email;

    public function mount(): void
    {
        $this->form->fill([
            'tiktok' => $this->getSetting('tiktok'),
            'facebook' => $this->getSetting('facebook'),
            'instagram' => $this->getSetting('instagram'),
            'linkedin' => $this->getSetting('linkedin'),
            'youtube' => $this->getSetting('youtube'),
            'number' => $this->getSetting('number'),
            'email' => $this->getSetting('email'),
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('tiktok')
                ->label('Tiktok URL')
                ->placeholder('https://www.tiktok.com/@yourusername')
                ->url()
                ->helperText('Masukkan URL akun Tiktok Anda.'),

            TextInput::make('facebook')
                ->label('Facebook URL')
                ->placeholder('https://www.facebook.com/yourpage')
                ->url()
                ->helperText('Masukkan URL halaman Facebook.'),

            TextInput::make('instagram')
                ->label('Instagram URL')
                ->placeholder('https://www.instagram.com/yourusername')
                ->url()
                ->helperText('Masukkan URL akun Instagram.'),

            TextInput::make('linkedin')
                ->label('LinkedIn URL')
                ->placeholder('https://www.linkedin.com/in/yourprofile')
                ->url()
                ->helperText('Masukkan URL profil LinkedIn.'),

            TextInput::make('youtube')
                ->label('Youtube URL')
                ->placeholder('https://www.youtube.com/@yourchannel')
                ->url()
                ->helperText('Masukkan URL channel YouTube.'),

            TextInput::make('number')
                ->label('Nomor Telepon / WhatsApp')
                ->placeholder('08123456789')
                ->tel()
                ->helperText('Masukkan nomor telepon aktif yang bisa dihubungi.'),

            TextInput::make('email')
                ->label('Email')
                ->placeholder('example@domain.com')
                ->email()
                ->helperText('Masukkan alamat email resmi.'),
        ];
    }


    public function submit()
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            Setelan::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        session()->flash('success', 'Pengaturan berhasil disimpan.');

        return redirect(request()->header('Referer') ?: url()->current());
    }

    protected function getSetting($key)
    {
        return Setelan::where('key', $key)->value('value');
    }
}
