<?php

namespace App\Services\Session;

use App\Models\Session;
use App\Repositories\Session\SessionRepository;
use Illuminate\Support\ServiceProvider;

class SessionServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('sessionService', function ($app) {
            return new SessionService(
                $app->make('App\Interfaces\Repositories\SessionInterface')
            );
        });

        $this->app->bind('App\Interfaces\Repositories\SessionInterface', function ($app) {
            return new SessionRepository(
                new Session()
            );
        });
    }
}