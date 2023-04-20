<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\MovieApiService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ApiService::class, function () {
            return new MovieApiService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
