<?php

namespace App\Services\Transaction;

use App\Http\Requests\Transaction\TransactionAllInterface;
use App\Http\Requests\Transaction\TransactionCreateInterface;
use App\Http\Requests\Transaction\TransactionDeleteInterface;
use App\Http\Requests\Transaction\TransactionInfoInterface;
use App\Http\Requests\Transaction\TransactionUpdateInterface;
use App\Interfaces\Repositories\TransactionInterface;
use App\Services\Payment\PaymentService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TransactionService
 * @package App\Services\Transaction
 */
class TransactionService
{
    private TransactionInterface $repo;
    private PaymentService $paymentService;

    /**
     * TransactionService constructor.
     * @param TransactionInterface $repo
     */
    public function __construct(TransactionInterface $repo, PaymentService $paymentService)
    {
        $this->repo = $repo;
        $this->paymentService = $paymentService;
    }

    /**
     * @param TransactionDeleteInterface $delete
     * @return bool
     */
    public function delete(TransactionDeleteInterface $delete): bool
    {
        return $this->repo->delete($delete);
    }

    /**
     * @param TransactionUpdateInterface $update
     * @return bool
     */
    public function update(TransactionUpdateInterface $update): bool
    {
        return $this->repo->update($update);
    }

    /**
     * @param TransactionInfoInterface $info
     * @return Model
     */
    public function info(TransactionInfoInterface $info): Model
    {
        return $this->repo->info($info);
    }

    /**
     * @param TransactionAllInterface $all
     * @return LengthAwarePaginator
     */
    public function all(TransactionAllInterface $all): LengthAwarePaginator
    {
        return $this->repo->all($all);
    }

    /**
     * @param TransactionCreateInterface $create
     * @return Model|null
     */
    public function add(TransactionCreateInterface $create): ?Model
    {
        if ($this->paymentService->checkAmountValid($create->getPaymentId(), $create->getAmount())) {
            return $this->repo->add($create);
        }

        return null;
    }

}
