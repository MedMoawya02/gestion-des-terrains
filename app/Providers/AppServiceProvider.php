<?php

namespace App\Providers;

use App\Interfaces\DashboardRepositoryInterface;
use App\Interfaces\TerrainRepositoryInterface;
use App\Repositories\DashboardRepository;
use App\Repositories\TerrainRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TerrainRepositoryInterface::class,TerrainRepository::class);
        $this->app->bind(DashboardRepositoryInterface::class,DashboardRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
