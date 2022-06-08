<?php

namespace Tests\Unit\DTO\Currency;

use App\DTO\Currency\PaymentCurrencyItemDTO;
use PHPUnit\Framework\TestCase;

class PaymentCurrencyItemDTOTest extends TestCase
{
    /**
     * @dataProvider itemDataProvider
     *
     * @return void
     */
    public function testItem(int $paymentId, int $currencyId)
    {
        $paymentCurrencyItemDTO = new PaymentCurrencyItemDTO($paymentId, $currencyId);

        $this->assertEquals($paymentId, $paymentCurrencyItemDTO->getPaymentId());
        $this->assertEquals($currencyId, $paymentCurrencyItemDTO->getCurrencyId());
    }

    public function itemDataProvider(): array
    {
        return [
            [1, 2],
            [2, 1],
            [2, 2],
        ];
    }
}
