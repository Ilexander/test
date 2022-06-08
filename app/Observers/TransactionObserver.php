<?php

namespace App\Observers;

use App\Models\Transaction;
use App\Services\Transaction\TransactionBonusFacade;

class TransactionObserver
{
    public function saving(Transaction $transaction)
    {
        if ($transaction->isDirty('status') && $transaction->status === Transaction::STATUS_SUCCESS) {
            TransactionBonusFacade::create($transaction);
        }
    }
}
