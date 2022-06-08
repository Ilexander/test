<?php

namespace App\DTO\Transaction;

use App\Models\Transaction;

class TransactionBonusItemDTO
{
    private Transaction $transaction;
    private int $amount;

    public function __construct(
        Transaction $transaction,
        int $amount
    ) {
        $this->transaction = $transaction;
        $this->amount = $amount;
    }

    public function getTransaction(): Transaction
    {
        return $this->transaction;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }
}