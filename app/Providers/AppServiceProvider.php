<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Memaksa skema HTTPS jika diakses melalui tunneling Ngrok
        if (request()->hasHeader('x-forwarded-proto')) {
            URL::forceScheme('https');
        }
    }
}