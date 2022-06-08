<?php

namespace App\Services\Payment;

use App\Models\Payment;
use App\Repositories\Payment\PaymentRepository;
use App\Services\Currency\CurrencyService;
use App\Services\Image\ImageService;
use Illuminate\Support\ServiceProvider;

/**
 * Class PaymentServiceServiceProvider
 * @package App\Services\Payment
 */
class PaymentServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('paymentService', function($app) {
            return new PaymentService(
                $app->make('App\Interfaces\Repositories\PaymentInterface'),
                new ImageService(),
                new CurrencyService(
                    $app->make('App\Interfaces\Repositories\CurrencyInterface'),
                    $app->make('App\Interfaces\Repositories\PaymentCurrencyInterface')
                )
            );
        });

        $this->app->bind('App\Interfaces\Repositories\PaymentInterface', function($app) {
            return new PaymentRepository(new Payment());
        });
    }
}