<?php

namespace App\Interfaces\Repositories;

use App\DTO\Transaction\TransactionBonusItemDTO;
use Illuminate\Database\Eloquent\Model;

interface TransactionBonusInterface
{
    /**
     * @param TransactionBonusItemDTO $bonusItemDTO
     * @return Model
     */
    public function create(TransactionBonusItemDTO $bonusItemDTO): Model;

    /**
     * @param int $transactionBonusId
     * @return bool
     */
    public function delete(int $transactionBonusId): bool;

    /**
     * @param int $transactionId
     * @return Model|null
     */
    public function info(int $transactionId): ?Model;
}