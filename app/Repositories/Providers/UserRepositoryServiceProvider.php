<?php

namespace App\Repositories\Providers;

use Illuminate\Support\ServiceProvider;

class UserRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Contracts\UserRepositoryInterface',
            'App\Repositories\Eloquent\UserRepository'
        );
    }
}