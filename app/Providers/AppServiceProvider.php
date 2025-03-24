<?php

namespace App\Providers;

use App\Models\Plant;
use App\Repositories\CategoryRepository;
use App\Repositories\Interface\CategoryRepositoryInterface;
use App\Repositories\Interface\OrderRepositoryInterface;
use App\Repositories\Interface\PlantRepositoryInterface;
use App\Repositories\OrderRepository;
use App\Repositories\PlantRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(PlantRepositoryInterface::class,PlantRepository::class);
        $this->app->bind(OrderRepositoryInterface::class,OrderRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
