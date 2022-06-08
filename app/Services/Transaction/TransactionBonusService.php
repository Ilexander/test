<?php

namespace App\Services\Transaction;

use App\DTO\Transaction\TransactionBonusItemDTO;
use App\Http\Requests\Payment\PaymentInfoRequest;
use App\Interfaces\Repositories\TransactionBonusInterface;
use App\Models\Transaction;
use App\Services\Payment\PaymentService;

class TransactionBonusService
{
    private TransactionBonusInterface $repo;

    public function __construct(
        TransactionBonusInterface $repo
    ) {
        $this->repo = $repo;
    }

    public function create(Transaction $transaction): void
    {
        $bonus = $transaction->payment->bonus;

        if (
            $bonus
            && $transaction->amount >= $bonus->bonus_start_funds
            && !$this->repo->info($transaction->id)
        ) {
            $transactionBonus = new TransactionBonusItemDTO(
                $transaction,
                ($transaction->amount / 100 * $bonus->percentage)
            );

            $this->repo->create($transactionBonus);
        }
    }
}