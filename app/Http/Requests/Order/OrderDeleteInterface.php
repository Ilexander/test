<?php

namespace App\Http\Requests\Order;

interface OrderDeleteInterface
{
    public function getId(): int;
    public function getUserId(): int;
}