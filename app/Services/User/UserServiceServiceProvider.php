<?php

namespace App\Services\User;

use App\Models\User;
use App\Models\UserCanceledPayment;
use App\Repositories\User\UserCanceledPaymentRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class UserServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('userService', function($app) {
            return new UserService(
                $app->make('App\Interfaces\Repositories\UserInterface')
            );
        });

        $this->app->bind('App\Interfaces\Repositories\UserInterface', function($app) {
            return new UserRepository(
                new User()
            );
        });

        $this->app->bind('UserCanceledPaymentService', function ($app) {
            return new UserCanceledPaymentService(
                $app->make('App\Interfaces\Repositories\UserCanceledPaymentInterface')
            );
        });

        $this->app->bind('App\Interfaces\Repositories\UserCanceledPaymentInterface', function($app) {
            return new UserCanceledPaymentRepository(
                new UserCanceledPayment()
            );
        });
    }
}