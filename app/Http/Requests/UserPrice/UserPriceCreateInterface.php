<?php

namespace App\Http\Requests\UserPrice;

interface UserPriceCreateInterface
{
    public function getUserId(): int;

    public function getServiceId(): ?int;

    public function getServicePrice(): ?float;

    public function getServices(): ?array;

    public function getServicePrices(): ?array;
}
