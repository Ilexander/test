<?php

namespace Tests\Unit\DTO\Payment;

use App\DTO\Payment\RequestSuccessDTO;
use PHPUnit\Framework\TestCase;

class RequestSuccessDTOTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @dataProvider requestDataProvider
     *
     * @param string $transactionId
     * @param string $redirectUrl
     * @param string $paymentName
     * @param string $urlData
     * @return void
     */
    public function testRequest(
        string $transactionId,
        string $redirectUrl,
        string $paymentName,
        string $urlData
    ): void{
        $requestSuccess = new RequestSuccessDTO(
            $transactionId,
            $redirectUrl,
            $paymentName,
            $urlData
        );

        $this->assertEquals($transactionId, $requestSuccess->getTransactionId());
        $this->assertEquals($redirectUrl, $requestSuccess->getRedirectUrl());
        $this->assertEquals($paymentName, $requestSuccess->getPaymentName());
        $this->assertEquals($urlData, $requestSuccess->getUrlData());
    }

    public function requestDataProvider(): array
    {
        return [
            [
                "10",
                "some redirect url",
                "cent App",
                "some url data"
            ],
            [
                "12",
                "first redirect url",
                "Payeer",
                "some url data"
            ]
        ];
    }
}
