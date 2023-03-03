<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
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
    public function boot(Request $request): void
    {
        Blade::if('customer', function () {
            return auth()->check() && auth()->user()->auth === 'CUSTOMER';
        });
        Blade::if('admin', function () {
            return auth()->check() && auth()->user()->auth === 'ADMIN';
        });
    }
}
