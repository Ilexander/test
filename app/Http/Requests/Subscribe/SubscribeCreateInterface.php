<?php

namespace App\Http\Requests\Subscribe;

interface SubscribeCreateInterface
{
    public function getFirstName(): ?string;
    public function getLastName(): ?string;
    public function getEmail(): string;
    public function getIp(): ?string;
    public function getCountryCode(): string;
}
