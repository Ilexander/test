<?php

namespace App\Services\Subscribe;

use App\Models\Subscribe;
use App\Repositories\Subscribe\SubscribeRepository;
use Illuminate\Support\ServiceProvider;

class SubscribeServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('subscribeService', function($app) {
            return new SubscribeService(
                $app->make('App\Interfaces\Repositories\SubscribeInterface')
            );
        });

        $this->app->bind('App\Interfaces\Repositories\SubscribeInterface', function($app) {
            return new SubscribeRepository(new Subscribe());
        });
    }
}