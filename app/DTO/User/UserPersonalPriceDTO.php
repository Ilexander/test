<?php

namespace App\DTO\User;

class UserPersonalPriceDTO
{
    private int $userId;
    private int $serviceId;
    private float $servicePrice;

    public function __construct(
        int $userId,
        int $serviceId,
        float $servicePrice
    ) {
        $this->userId = $userId;
        $this->serviceId = $serviceId;
        $this->servicePrice = $servicePrice;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getServiceId(): int
    {
        return $this->serviceId;
    }

    public function getServicePrice(): float
    {
        return $this->servicePrice;
    }
}