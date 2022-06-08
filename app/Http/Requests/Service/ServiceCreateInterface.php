<?php

namespace App\Http\Requests\Service;

interface ServiceCreateInterface
{
    public function getUserId(): int;
    public function getCategoryId(): int;
    public function getName(): string;
    public function getDesc(): string;
    public function getPrice(): float;
    public function getOriginalPrice(): float;
    public function getMin(): int;
    public function getMax(): int;
    public function getAddType(): string;
    public function getType(): string;
    public function getApiServiceId(): string;
    public function getApiProviderId(): int;
    public function getDripFeed(): bool;
    public function getStatus(): bool;
}