<?php

namespace App\Services\Currency;

use App\Models\Currency;
use App\Models\PaymentCurrency;
use App\Repositories\Currency\CurrencyRepository;
use App\Repositories\Payment\PaymentCurrencyRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Class CurrencyServiceServiceProvider
 * @package App\Services\Currency
 */
class CurrencyServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('currencyService', function($app) {
            return new CurrencyService(
                $app->make('App\Interfaces\Repositories\CurrencyInterface'),
                $app->make('App\Interfaces\Repositories\PaymentCurrencyInterface')
            );
        });

        $this->app->bind('App\Interfaces\Repositories\CurrencyInterface', function($app) {
            return new CurrencyRepository(new Currency());
        });
        $this->app->bind('App\Interfaces\Repositories\PaymentCurrencyInterface', function($app) {
            return new PaymentCurrencyRepository(new PaymentCurrency());
        });
    }
}