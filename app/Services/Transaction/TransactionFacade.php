<?php

namespace App\Services\Transaction;

use App\Http\Requests\Transaction\TransactionAllInterface;
use App\Http\Requests\Transaction\TransactionCreateInterface;
use App\Http\Requests\Transaction\TransactionDeleteInterface;
use App\Http\Requests\Transaction\TransactionInfoInterface;
use App\Http\Requests\Transaction\TransactionUpdateInterface;
use Illuminate\Support\Facades\Facade;

/**
 * Class TransactionFacade
 * @package App\Services\Transaction
 *
 * @method static delete(TransactionDeleteInterface $delete)
 * @method static update(TransactionUpdateInterface $update)
 * @method static info(TransactionInfoInterface $info)
 * @method static all(TransactionAllInterface $all)
 * @method static add(TransactionCreateInterface $create)
 */
class TransactionFacade extends Facade
{
    protected static function getFacadeAccessor() { return 'transactionService'; }
}