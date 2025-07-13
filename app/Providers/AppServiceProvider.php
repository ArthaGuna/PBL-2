<?php

namespace App\Providers;

use App\Models\Informasi;
use App\Models\Setelan;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $informasi = Informasi::first();

            $sosmed = [
                'wa' => ($number = Setelan::where('key', 'number')->value('value'))
                    ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $number)
                    : null,
                'number' => $number,
                'facebook' => Setelan::where('key', 'facebook')->value('value'),
                'linkedin' => Setelan::where('key', 'linkedin')->value('value'),
                'youtube' => Setelan::where('key', 'youtube')->value('value'),
                'instagram' => Setelan::where('key', 'instagram')->value('value'),
                'email' => Setelan::where('key', 'email')->value('value'),
            ];

            $view->with(compact('informasi', 'sosmed'));
        });
    }
}
