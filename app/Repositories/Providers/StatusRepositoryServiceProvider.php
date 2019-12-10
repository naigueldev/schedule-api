<?php

namespace App\Repositories\Providers;

use Illuminate\Support\ServiceProvider;

class StatusRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Contracts\StatusRepositoryInterface',
            'App\Repositories\Eloquent\StatusRepository'
        );
    }
}