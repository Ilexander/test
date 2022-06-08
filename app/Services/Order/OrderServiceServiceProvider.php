<?php

namespace App\Services\Order;

use App\Models\Order;
use App\Repositories\Order\OrderRepository;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class OrderServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('orderService', function($app) {
            return new OrderService(
                $app->make('App\Interfaces\Repositories\OrderInterface'),
                new OrderApiService(new Client())
            );
        });

        $this->app->bind('App\Interfaces\Repositories\OrderInterface', function($app) {
            return new OrderRepository(new Order());
        });
    }
}