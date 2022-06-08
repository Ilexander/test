<?php

namespace App\Repositories\Transaction;

use App\DTO\Transaction\TransactionBonusItemDTO;
use App\Interfaces\Repositories\TransactionBonusInterface;
use App\Models\TransactionBonus;
use Illuminate\Database\Eloquent\Model;

class TransactionBonusRepository implements TransactionBonusInterface
{
    private TransactionBonus $transactionBonus;

    public function __construct(TransactionBonus $transactionBonus)
    {
        $this->transactionBonus = $transactionBonus;
    }

    public function create(TransactionBonusItemDTO $bonusItemDTO): Model
    {
        /** @var TransactionBonus $transactionBonus */
        $transactionBonus = new $this->transactionBonus();
        $transactionBonus->fill([
            'transaction_id'    => $bonusItemDTO->getTransaction()->id,
            'amount'            => $bonusItemDTO->getAmount()
        ]);
        $transactionBonus->save();

        return $transactionBonus;
    }

    public function delete(int $transactionBonusId): bool
    {
        return $this
            ->transactionBonus
            ->newQuery()
            ->where('id', $transactionBonusId)
            ->delete();
    }

    public function info(int $transactionId): ?Model
    {
        return $this
            ->transactionBonus
            ->newQuery()
            ->where('transaction_id', $transactionId)
            ->first();
    }
}