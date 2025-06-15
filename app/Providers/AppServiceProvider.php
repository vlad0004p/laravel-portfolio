<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Schema;

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
        // Set default string length for MySQL
        Schema::defaultStringLength(191);

        // Force HTTPS in production or when FORCE_HTTPS is true
        if (env('APP_ENV') === 'production' || env('FORCE_HTTPS', false)) {
            URL::forceScheme('https');
        }

        // Trust all proxies (for Render.com)
        if (env('APP_ENV') === 'production') {
            request()->server->set('HTTPS', 'on');
        }
    }
}
