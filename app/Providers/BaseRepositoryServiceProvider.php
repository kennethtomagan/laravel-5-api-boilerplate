<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Users\Repositories\UserRepository;
use App\Models\Users\Repositories\UserRepositoryInterface;

class BaseRepositoryServiceProvider extends ServiceProvider
{

    /**
     * Bind the interface to an implementation repository class
     */
    public function register()
    {

        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

    }
    
}
