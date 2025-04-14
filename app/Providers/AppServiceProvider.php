<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
    public function boot(): void
    {
        // Puedes dejar solo esta línea si estás haciendo pruebas con ngrok
        URL::forceScheme('https');

        // O si quieres limitarlo solo a producción, usa esta:
        // if (app()->environment('production')) {
        //     URL::forceScheme('https');
        // }
    }
}
