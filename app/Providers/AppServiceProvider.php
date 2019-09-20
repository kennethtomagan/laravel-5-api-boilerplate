<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Sites\Repositories\SiteRepository;
use App\Models\Sites\Repositories\SiteRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            SiteRepositoryInterface::class,
            SiteRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }
}
