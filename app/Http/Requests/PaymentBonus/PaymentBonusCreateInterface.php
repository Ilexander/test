<?php

namespace App\Http\Requests\PaymentBonus;

interface PaymentBonusCreateInterface
{
    public function getPaymentId(): int;

    public function getBonusStartFunds(): int;

    public function getPercentage(): int;

    public function getStatus(): bool;
}