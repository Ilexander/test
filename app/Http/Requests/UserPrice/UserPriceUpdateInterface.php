<?php

namespace App\Http\Requests\UserPrice;

interface UserPriceUpdateInterface
{
    public function getId(): int;
    
    public function getUserId(): int;

    public function getServiceId(): int;

    public function getServicePrice(): float;
}