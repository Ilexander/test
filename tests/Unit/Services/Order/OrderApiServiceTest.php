<?php

namespace Tests\Unit\Services\Order;

use App\Services\Order\OrderApiService;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Tests\TestCase;

class OrderApiServiceTest extends TestCase
{
    /**
     * @dataProvider connectApiItemData
     *
     * @return void
     */
    public function testConnectApi(string $url, int $status, array $post, string $body)
    {
        $mock = new MockHandler([new Response($status, [], $body)]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $orderApiService = new OrderApiService($client);
        $result = $orderApiService->connectApi($url, $post);

        $body = json_decode($body, true);

        $this->assertEquals($status, $result['status']);
        $this->assertEquals($body['message'], $result['message']);
        $this->assertEquals($body['errors']['link'][0], $result['errors']['link'][0]);
    }

    public function connectApiItemData()
    {
        return [
            [
                "https://hqsmartpanel.com/api/v1",
                200,
                [
                    'key' 	   => 'JIyPCexcfKPOjsSGlcjHYV4n5yRsVgCE',
                    'action'   => 'add',
                    'service'  => 1051,
                    'link'     => 'https://www.instagram.com/russik/',
                    'quantity' => 2000
                ],
                file_get_contents(__DIR__.'/Mock/incorrect-post-link-response.txt')
            ],
//            [
//                "https://vinasmm.com/api/v2",
//                [
//                    'key' 	   => '9d4b547e634dba2330ae3b6c148918fa',
//                    'action'   => 'add',
//                    'service'  => 1201,
//                    'link'     => 'https://www.instagram.com/russik',
//                    'quantity' => 2000
//                ],
//            ]
        ];
    }
}
