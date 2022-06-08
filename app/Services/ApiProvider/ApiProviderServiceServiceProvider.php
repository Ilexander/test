<?php

namespace App\Services\ApiProvider;

use App\Models\ApiProvider;
use App\Repositories\ApiProvider\ApiProviderRepository;
use Illuminate\Support\ServiceProvider;

class ApiProviderServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('apiProviderService', function($app) {
            return new ApiProviderService(
                $app->make('App\Interfaces\Repositories\ApiProviderInterface'),
                new ApiProviderApiService()
            );
        });

        $this->app->bind('App\Interfaces\Repositories\ApiProviderInterface', function($app) {
            return new ApiProviderRepository(new ApiProvider());
        });
    }
}