<?php

namespace App\Providers;

use App\Services\UserService;
use App\Services\SarprasService;
use App\Services\SekolahService;
use App\Services\KehadiranService;
use App\Services\PertemuanService;
use App\Services\UserServiceInterface;
use Illuminate\Support\ServiceProvider;
use App\Services\SarprasServiceInterface;
use App\Services\SekolahServiceInterface;
use App\Services\KehadiranServiceInterface;
use App\Services\PertemuanServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(SekolahServiceInterface::class, SekolahService::class);
        $this->app->bind(SarprasServiceInterface::class, SarprasService::class);
        $this->app->bind(KehadiranServiceInterface::class, KehadiranService::class);
        $this->app->bind(PertemuanServiceInterface::class, PertemuanService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
