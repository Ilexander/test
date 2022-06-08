<?php

namespace App\Services\Service;

use App\Models\Service;
use App\Repositories\Service\ServiceRepository;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('serviceService', function($app) {
            return new ServiceService(
                $app->make('App\Interfaces\Repositories\ServiceInterface')
            );
        });

        $this->app->bind('App\Interfaces\Repositories\ServiceInterface', function($app) {
            return new ServiceRepository(new Service());
        });
    }
}