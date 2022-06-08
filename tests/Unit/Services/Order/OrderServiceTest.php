<?php

namespace Tests\Unit\Services\Order;

use App\Interfaces\Repositories\OrderInterface;
use App\Services\Order\OrderApiService;
use App\Services\Order\OrderService;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class OrderServiceTest extends TestCase
{
    private OrderService $orderService;

    protected function setUp(): void
    {
        parent::setUp();

//        OrderInterface $repo,
//        OrderApiService $apiService

        $this->mock =

        $this->orderService = new OrderService();
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }


    private function getPostcodes($link, $status, $requestData = null, $body = null)
    {
        $mock = new MockHandler([new Response($status, [], $body)]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $orderApiService = new OrderApiService($client);

        return $orderApiService->connectApi($link, $requestData);
    }
}
