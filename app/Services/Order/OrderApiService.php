<?php

namespace App\Services\Order;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class OrderApiService
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function connectApi($url, $post = [])
    {
        $_post = [];
        if (is_array($post)) {
            foreach ($post as $name => $value) {
                $_post[] = $name.'='.urlencode($value);
            }
        }

        $curl = [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POST => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_USERAGENT => 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)'
        ];

        if (is_array($post)) {
            $curl[CURLOPT_POSTFIELDS] = join('&', $_post);
        }
        try {
            $result = $this->client->request('POST', $url, [
                'form_params' => $post,
                'curl'        => $curl
            ]);
        } catch (GuzzleException $e) {
            return json_decode($e->getResponse()->getBody()->getContents(), true);
        }

        return json_decode($result->getBody()->getContents(), true);
    }
}