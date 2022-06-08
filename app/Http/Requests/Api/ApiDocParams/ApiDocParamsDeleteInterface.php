<?php

namespace App\Http\Requests\Api\ApiDocParams;

interface ApiDocParamsDeleteInterface
{
    public function getId(): ?int;
    public function getApiDocId(): ?int;
}