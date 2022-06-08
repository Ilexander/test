<?php

namespace App\Http\Requests\Order;

interface OrderCreateInterface
{
    public function getCategoryId(): ?int;
    public function getServiceId(): ?int;
    public function getLink(): ?string;
    public function getQuantity(): ?string;
    public function getUserId(): ?int;
    public function setUserId(?int $user_id);
}