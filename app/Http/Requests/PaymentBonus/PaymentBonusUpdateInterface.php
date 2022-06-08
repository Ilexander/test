<?php

namespace App\Http\Requests\PaymentBonus;

interface PaymentBonusUpdateInterface
{
    public function getId(): int;

    public function getPaymentId(): int;

    public function getBonusStartFunds(): int;

    public function getPercentage(): int;

    public function getStatus(): bool;
}