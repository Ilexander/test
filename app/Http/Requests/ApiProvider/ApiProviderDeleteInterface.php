<?php

namespace App\Http\Requests\ApiProvider;

interface ApiProviderDeleteInterface
{
    public function getId(): int;
    public function getUserId(): int;
}