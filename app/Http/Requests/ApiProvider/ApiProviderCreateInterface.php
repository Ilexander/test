<?php

namespace App\Http\Requests\ApiProvider;

interface ApiProviderCreateInterface
{
    public function getUserId(): int;
    public function getName(): string;
    public function getUrl(): string;
    public function getKey(): string;
    public function getType(): string;
    public function getBalance(): float;
    public function getCurrencyCode(): string;
    public function getDescription(): string;
    public function getStatus(): bool;
}