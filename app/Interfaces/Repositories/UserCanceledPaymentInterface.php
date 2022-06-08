<?php

namespace App\Interfaces\Repositories;

use App\DTO\User\UserCanceledPaymentCollectionDTO;
use Illuminate\Database\Eloquent\Collection;

interface UserCanceledPaymentInterface
{
    /**
     * @param UserCanceledPaymentCollectionDTO $canceledPaymentCollectionDTO
     * @return void
     */
    public function create(UserCanceledPaymentCollectionDTO $canceledPaymentCollectionDTO): void;

    /**
     * @param int $user_id
     * @param int $payment_id
     * @return bool
     */
    public function delete(int $user_id, int $payment_id): bool;

    /**
     * @param int $user_id
     * @return Collection
     */
    public function getForUser(int $user_id): Collection;

    /**
     * @param int $payment_id
     * @return Collection
     */
    public function getForPayment(int $payment_id): Collection;

    /**
     * @param int $user_id
     * @return bool
     */
    public function deleteForUser(int $user_id): bool;

    /**
     * @param int $payment_id
     * @return bool
     */
    public function deleteForPayment(int $payment_id): bool;
}