<?php

namespace App\Services\Transaction;

use App\Models\Transaction;
use Illuminate\Support\Facades\Facade;

/**
* @method static create(Transaction $transaction)
 *
*/
class TransactionBonusFacade extends Facade
{
    protected static function getFacadeAccessor() { return 'transactionBonusService'; }
}