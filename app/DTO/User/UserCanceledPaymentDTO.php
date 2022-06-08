<?php

namespace App\DTO\User;

use App\Models\Payment;
use App\Models\User;

class UserCanceledPaymentDTO
{
    private User $user;
    private Payment $payment;

    public function __construct(User $user, Payment $payment)
    {
        $this->user = $user;
        $this->payment = $payment;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getPayment(): Payment
    {
        return $this->payment;
    }
}