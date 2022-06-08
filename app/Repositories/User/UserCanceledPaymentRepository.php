<?php

namespace App\Repositories\User;

use App\DTO\User\UserCanceledPaymentCollectionDTO;
use App\Interfaces\Repositories\UserCanceledPaymentInterface;
use App\Models\UserCanceledPayment;
use Illuminate\Database\Eloquent\Collection;

class UserCanceledPaymentRepository implements UserCanceledPaymentInterface
{
    private UserCanceledPayment $userCanceledPayment;

    public function __construct(UserCanceledPayment $userCanceledPayment)
    {
        $this->userCanceledPayment = $userCanceledPayment;
    }

    public function create(UserCanceledPaymentCollectionDTO $canceledPaymentCollectionDTO): void
    {
        $insert = [];
        while ($canceledPaymentCollectionDTO->current()) {
            $currentItem = $canceledPaymentCollectionDTO->getItem($canceledPaymentCollectionDTO->getCurrentKey());

            $insert[] = [
                'user_id'       => $currentItem->getUser()->id,
                'payment_id'    => $currentItem->getPayment()->id
            ];

            $canceledPaymentCollectionDTO->next();
        }

        $this->userCanceledPayment->newQuery()->insert($insert);
    }

    public function delete(int $user_id, int $payment_id): bool
    {
        return $this->userCanceledPayment->newQuery()
            ->where('user_id', $user_id)
            ->where('payment_id', $payment_id)
            ->delete();
    }

    public function getForUser(int $user_id): Collection
    {
        return $this->userCanceledPayment->newQuery()
            ->where('user_id', $user_id)
            ->get();
    }

    public function getForPayment(int $payment_id): Collection
    {
        return $this->userCanceledPayment->newQuery()
            ->where('payment_id', $payment_id)
            ->get();
    }

    public function deleteForUser(int $user_id): bool
    {
        return $this->userCanceledPayment->newQuery()
            ->where('user_id', $user_id)
            ->delete();
    }

    public function deleteForPayment(int $payment_id): bool
    {
        return $this->userCanceledPayment->newQuery()
            ->where('payment_id', $payment_id)
            ->delete();
    }
}
