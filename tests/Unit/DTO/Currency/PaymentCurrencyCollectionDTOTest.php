<?php

namespace Tests\Unit\DTO\Currency;

use App\DTO\Currency\PaymentCurrencyCollectionDTO;
use App\DTO\Currency\PaymentCurrencyItemDTO;
use PHPUnit\Framework\TestCase;

class PaymentCurrencyCollectionDTOTest extends TestCase
{
    /**
     * @dataProvider collectionDataProvider
     *
     * @return void
     */
    public function testCollection(PaymentCurrencyItemDTO $paymentCurrencyItem)
    {
        $paymentCollection = new PaymentCurrencyCollectionDTO();
        $paymentCollection->add($paymentCurrencyItem);

        /** @var PaymentCurrencyItemDTO $item */
        foreach ($paymentCollection->list() as $item) {
            $this->assertEquals($paymentCurrencyItem->getPaymentId(), $item->getPaymentId());
            $this->assertEquals($paymentCurrencyItem->getCurrencyId(), $item->getCurrencyId());
        }
    }

    public function collectionDataProvider(): array
    {
        $firstPaymentCurrencyItemDTO = new PaymentCurrencyItemDTO(1, 1);
        $secondPaymentCurrencyItemDTO = new PaymentCurrencyItemDTO(1, 2);
        $thirdPaymentCurrencyItemDTO = new PaymentCurrencyItemDTO(2, 1);

        return [
            [$firstPaymentCurrencyItemDTO],
            [$secondPaymentCurrencyItemDTO],
            [$thirdPaymentCurrencyItemDTO],
        ];
    }
}
