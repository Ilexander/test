<?php

namespace App\DTO\Service;

class ServiceItemDTO
{
    private int $userId;
    private int $categoryId;
    private string $name;
    private string $desc;
    private float $price;
    private float $originalPrice;
    private int $min;
    private int $max;
    private string $addType;
    private string $type;
    private string $apiServiceId;
    private int $apiProviderId;
    private bool $dripfeed;
    private bool $status;

    public function __construct(
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
    ) {
        $this->userId = $user_id;
        $this->categoryId = $category_id;
        $this->name = $name;
        $this->desc = $desc;
        $this->price = $price;
        $this->originalPrice = $original_price;
        $this->min = $min;
        $this->max = $max;
        $this->addType = $add_type;
        $this->type = $type;
        $this->apiServiceId = $api_service_id;
        $this->apiProviderId = $api_provider_id;
        $this->dripfeed = $dripfeed;
        $this->status = $status;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->desc;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getOriginalPrice(): float
    {
        return $this->originalPrice;
    }

    public function getMin(): int
    {
        return $this->min;
    }

    public function getMax(): int
    {
        return $this->max;
    }

    public function getAddType(): string
    {
        return $this->addType;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getApiServiceId(): string
    {
        return $this->apiServiceId;
    }

    public function getApiProviderId(): int
    {
        return $this->apiProviderId;
    }

    public function getDripFeed(): bool
    {
        return $this->dripfeed;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }
}