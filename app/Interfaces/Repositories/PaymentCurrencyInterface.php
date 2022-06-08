<?php

namespace App\Interfaces\Repositories;

use App\DTO\Currency\PaymentCurrencyCollectionDTO;

interface PaymentCurrencyInterface
{
    public function add(PaymentCurrencyCollectionDTO $currencyCollectionDTO): bool;

    public function update(int $paymentId, PaymentCurrencyCollectionDTO $currencyCollectionDTO): bool;

    public function delete(int $relationId): bool;

    public function deleteByPaymentId(int $paymentId): bool;
}