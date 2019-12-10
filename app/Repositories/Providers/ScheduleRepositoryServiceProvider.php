<?php

namespace App\Repositories\Providers;

use Illuminate\Support\ServiceProvider;

class ScheduleRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Contracts\ScheduleRepositoryInterface',
            'App\Repositories\Eloquent\ScheduleRepository'
        );
    }
}