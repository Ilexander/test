<?php

namespace Tests\Unit\DTO\Service;

use App\DTO\Service\ServiceItemDTO;
use PHPUnit\Framework\TestCase;

class ServiceItemDTOTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @dataProvider itemDataProvider
     *
     * @param int $user_id
     * @param int $category_id
     * @param string $name
     * @param string $desc
     * @param float $price
     * @param float $original_price
     * @param int $min
     * @param int $max
     * @param string $add_type
     * @param string $type
     * @param string $api_service_id
     * @param int $api_provider_id
     * @param bool $dripfeed
     * @param bool $status
     * @return void
     */
    public function testItem(
        int $user_id,
        int $category_id,
        string $name,
        string $desc,
        float $price,
        float $original_price,
        int $min,
        int $max,
        string $add_type,
        string $type,
        string $api_service_id,
        int $api_provider_id,
        bool $dripfeed,
        bool $status
    ): void {
        $serviceItemDTO = new ServiceItemDTO(
            $user_id,
            $category_id,
            $name,
            $desc,
            $price,
            $original_price,
            $min,
            $max,
            $add_type,
            $type,
            $api_service_id,
            $api_provider_id,
            $dripfeed,
            $status
        );

        $this->assertEquals($user_id, $serviceItemDTO->getUserId());
        $this->assertEquals($category_id, $serviceItemDTO->getCategoryId());
        $this->assertEquals($name, $serviceItemDTO->getName());
        $this->assertEquals($desc, $serviceItemDTO->getDescription());
        $this->assertEquals($price, $serviceItemDTO->getPrice());
        $this->assertEquals($original_price, $serviceItemDTO->getOriginalPrice());
        $this->assertEquals($min, $serviceItemDTO->getMin());
        $this->assertEquals($max, $serviceItemDTO->getMax());
        $this->assertEquals($add_type, $serviceItemDTO->getAddType());
        $this->assertEquals($type, $serviceItemDTO->getType());
        $this->assertEquals($api_service_id, $serviceItemDTO->getApiServiceId());
        $this->assertEquals($api_provider_id, $serviceItemDTO->getApiProviderId());
        $this->assertEquals($dripfeed, $serviceItemDTO->getDripFeed());
        $this->assertEquals($status, $serviceItemDTO->getStatus());
    }

    public function itemDataProvider()
    {
        return [
            [
                12,
                10,
                "name",
                "desc",
                1.5,
                1.3,
                10,
                100,
                "add_type",
                "type",
                "1932",
                1000,
                true,
                true
            ],
            [
                1,
                2,
                "name",
                "desc",
                2.6,
                2.1,
                120,
                1200,
                "add_type",
                "type",
                "1932",
                1000,
                false,
                false
            ],
        ];
    }
}
