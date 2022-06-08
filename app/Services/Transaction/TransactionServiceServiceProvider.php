<?php

namespace App\Services\Transaction;

use App\Models\Transaction;
use App\Models\TransactionBonus;
use App\Repositories\Currency\CurrencyRepository;
use App\Repositories\Transaction\TransactionBonusRepository;
use App\Repositories\Transaction\TransactionRepository;
use Illuminate\Support\ServiceProvider;

class TransactionServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('transactionService', function($app) {
            return new TransactionService(
                $app->make('App\Interfaces\Repositories\TransactionInterface'),
                $app->make('App\Services\Payment\PaymentService'),
            );
        });

        $this->app->bind('App\Interfaces\Repositories\TransactionInterface', function($app) {
            return new TransactionRepository(
                new Transaction(),
                $app->make('App\Interfaces\Repositories\CurrencyInterface')
            );
        });

        $this->app->bind('transactionBonusService', function($app) {
            return new TransactionBonusService(
                $app->make('App\Interfaces\Repositories\TransactionBonusInterface')
            );
        });

        $this->app->bind('App\Interfaces\Repositories\TransactionBonusInterface', function($app) {
            return new TransactionBonusRepository(
                new TransactionBonus()
            );
        });
    }
}
