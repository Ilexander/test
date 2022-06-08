<?php

namespace App\Interfaces\Repositories;

use App\Http\Requests\Transaction\TransactionAllInterface;
use App\Http\Requests\Transaction\TransactionCreateInterface;
use App\Http\Requests\Transaction\TransactionDeleteInterface;
use App\Http\Requests\Transaction\TransactionInfoInterface;
use App\Http\Requests\Transaction\TransactionUpdateInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface TransactionInterface
 * @package App\Interfaces\Repositories
 */
interface TransactionInterface
{
    /**
     * @param TransactionInfoInterface $info
     * @return Model
     */
    public function info(TransactionInfoInterface $info): Model;

    /**
     * @param TransactionAllInterface $all
     * @return Collection
     */
    public function all(TransactionAllInterface $all): LengthAwarePaginator;

    /**
     * @param TransactionUpdateInterface $update
     * @return bool
     */
    public function update(TransactionUpdateInterface $update): bool;

    /**
     * @param TransactionDeleteInterface $delete
     * @return bool
     */
    public function delete(TransactionDeleteInterface $delete): bool;

    /**
     * @param TransactionCreateInterface $create
     * @return Model|null
     */
    public function add(TransactionCreateInterface $create): ?Model;
}
