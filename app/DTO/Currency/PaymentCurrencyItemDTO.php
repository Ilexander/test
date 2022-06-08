<?php

namespace App\DTO\Currency;

class PaymentCurrencyItemDTO
{
    private int $paymentId;
    private int $currencyId;

    public function __construct(int $paymentId, int $currencyId)
    {
        $this->paymentId = $paymentId;
        $this->currencyId = $currencyId;
    }

    public function getPaymentId(): int
    {
        return $this->paymentId;
    }

    public function getCurrencyId(): int
    {
        return $this->currencyId;
    }
}