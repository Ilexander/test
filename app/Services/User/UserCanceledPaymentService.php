<?php

namespace App\Services\User;

use App\DTO\User\UserCanceledPaymentCollectionDTO;
use App\Interfaces\Repositories\UserCanceledPaymentInterface;
use Illuminate\Database\Eloquent\Collection;

class UserCanceledPaymentService
{
    private UserCanceledPaymentInterface $repo;

    public function __construct(UserCanceledPaymentInterface $repo)
    {
        $this->repo = $repo;
    }

    public function create(UserCanceledPaymentCollectionDTO $canceledPaymentCollectionDTO): void
    {
        $this->repo->create($canceledPaymentCollectionDTO);
    }

    public function delete(int $user_id, int $payment_id): bool
    {
        return $this->repo->delete($user_id, $payment_id);
    }

    public function getForUser(int $user_id): Collection
    {
        return $this->repo->getForUser($user_id);
    }

    public function getForPayment(int $payment_id): Collection
    {
        return $this->repo->getForPayment($payment_id);
    }

    public function deleteForUser(int $user_id): bool
    {
        return $this->repo->deleteForUser($user_id);
    }

    public function deleteForPayment(int $payment_id): bool
    {
        return $this->repo->deleteForPayment($payment_id);
    }
}
