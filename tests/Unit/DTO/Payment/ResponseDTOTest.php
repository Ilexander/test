<?php

namespace Tests\Unit\DTO\Payment;

use App\DTO\Payment\ResponseDTO;
use PHPUnit\Framework\TestCase;

class ResponseDTOTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @dataProvider responseDataProvider
     *
     * @param bool $status
     * @param string $message
     * @param string $redirectUrl
     * @return void
     */
    public function testResponse(
        bool $status,
        string $message,
        string $redirectUrl
    ): void {
        $response = new ResponseDTO( $status, $message, $redirectUrl);

        $this->assertEquals($status, $response->getStatus());
        $this->assertEquals($message, $response->getMessage());
        $this->assertEquals($redirectUrl, $response->getRedirectUrl());
    }

    public function responseDataProvider(): array
    {
        return [
            [
                true,
                'some message',
                'some redirect url',
            ],
            [
                false,
                'first message',
                'first redirect url',
            ]
        ];
    }
}
