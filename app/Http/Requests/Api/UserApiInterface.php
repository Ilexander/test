<?php

namespace App\Http\Requests\Api;

interface UserApiInterface
{
    public function getAction(): string;
    public function getKey(): string;
    public function getOrder(): ?int;
    public function getOrders(): ?array;
    public function getService(): ?int;
    public function getLink(): ?string;
    public function getQuantity(): ?int;
    public function getRuns(): ?int;
    public function getInterval(): ?int;
}