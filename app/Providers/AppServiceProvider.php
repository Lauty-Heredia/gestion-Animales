<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\SpeciesServiceInterface;
use App\Services\SQLSpeciesService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SpeciesServiceInterface::class, SQLSpeciesService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
