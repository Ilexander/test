<?php

namespace App\Services\Payment\PaymentBonus;

use App\Models\PaymentBonus;
use App\Repositories\Payment\PaymentBonusRepository;
use Illuminate\Support\ServiceProvider;

class PaymentBonusServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('paymentBonusService', function($app) {
            return new PaymentBonusService(
                $app->make('App\Interfaces\Repositories\PaymentBonusInterface'),
            );
        });

        $this->app->bind('App\Interfaces\Repositories\PaymentBonusInterface', function($app) {
            return new PaymentBonusRepository(new PaymentBonus());
        });
    }
}