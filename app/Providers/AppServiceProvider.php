<?php

namespace App\Providers;

use Illuminate\Pagination\PaginationServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Weather;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Weather::class, fn () => new Weather('demo'));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
