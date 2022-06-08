<?php

namespace App\Services\Api;

use App\Models\ApiDoc;
use App\Models\ApiDocParams;
use App\Repositories\ApiDoc\ApiDocParamsRepository;
use App\Repositories\ApiDoc\ApiDocRepository;
use Illuminate\Support\ServiceProvider;

class ApiDocServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('apiDocService', function ($app) {
            return new ApiDocService(
                $app->make('App\Interfaces\Repositories\ApiDocInterface')
            );
        });

        $this->app->bind('App\Interfaces\Repositories\ApiDocInterface', function () {
            return new ApiDocRepository(new ApiDoc());
        });

        $this->app->bind('apiDocParamsService', function ($app) {
            return new ApiDocParamsService(
                $app->make('App\Interfaces\Repositories\ApiDocParamsInterface')
            );
        });

        $this->app->bind('App\Interfaces\Repositories\ApiDocParamsInterface', function () {
            return new ApiDocParamsRepository(new ApiDocParams());
        });
    }
}