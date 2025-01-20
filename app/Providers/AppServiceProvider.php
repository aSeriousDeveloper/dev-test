<?php

namespace App\Providers;

use App\Services\CatApiService;
use GuzzleHttp\Client;
use Illuminate\Cache\Repository as CacheRepository;
use Illuminate\Config\Repository as ConfigRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\DateFactory;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CatApiService::class, function(Application $app) {
            return new CatApiService(
                $app->get(CacheRepository::class),
                $app->get(ConfigRepository::class),
                $app->get(DateFactory::class),
                $app->get(Client::class),
            );
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
