<?php

namespace App\Services\UserPrice;

use App\Models\UserPrice;
use App\Repositories\UserPrice\UserPriceRepository;
use Illuminate\Support\ServiceProvider;

class UserPriceServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('userPriceService', function($app) {
            return new UserPriceService(
                $app->make('App\Interfaces\Repositories\UserPriceInterface')
            );
        });

        $this->app->bind('App\Interfaces\Repositories\UserPriceInterface', function($app) {
            return new UserPriceRepository(
                new UserPrice()
            );
        });
    }
}