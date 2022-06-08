<?php

namespace App\Http\Requests\Order;

interface OrderUpdateInterface
{
    public function getId(): int;
    public function getUserId(): ?int;
    public function getLink(): ?string;
    public function getStatus(): ?string;
    public function getStartCounter(): ?string;
    public function getRemains(): ?string;
    public function getRuns(): ?int;
    public function getInterval(): ?int;
}