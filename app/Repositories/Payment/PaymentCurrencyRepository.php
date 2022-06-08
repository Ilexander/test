<?php

namespace App\Repositories\Payment;

use App\DTO\Currency\PaymentCurrencyCollectionDTO;
use App\DTO\Currency\PaymentCurrencyItemDTO;
use App\Interfaces\Repositories\PaymentCurrencyInterface;
use App\Models\PaymentCurrency;

class PaymentCurrencyRepository implements PaymentCurrencyInterface
{
    private PaymentCurrency $paymentCurrency;

    public function __construct(PaymentCurrency $paymentCurrency)
    {
        $this->paymentCurrency = $paymentCurrency;
    }

    public function add(PaymentCurrencyCollectionDTO $currencyCollectionDTO): bool
    {
        $insertArray = [];

        /** @var PaymentCurrencyItemDTO $item */
        foreach ($currencyCollectionDTO->list() as $item) {
            $insertArray[] = [
                'payment_id'    => $item->getPaymentId(),
                'currency_id'   => $item->getCurrencyId()
            ];
        }

        $this->paymentCurrency->newQuery()->insert($insertArray);

        return true;
    }

    public function update(int $paymentId, PaymentCurrencyCollectionDTO $currencyCollectionDTO): bool
    {
        $this->deleteByPaymentId($paymentId);
        $this->add($currencyCollectionDTO);

        return true;
    }

    public function delete(int $relationId): bool
    {
       return $this->paymentCurrency->newQuery()->find($relationId)->delete();
    }

    public function deleteByPaymentId(int $paymentId): bool
    {
        return $this
            ->paymentCurrency
            ->newQuery()
            ->where('payment_id', $paymentId)
            ->delete();
    }
}