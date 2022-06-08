<?php

namespace App\Http\Requests\Api\ApiDocParams;

interface ApiDocParamsCreateInterface
{
    public function getApiDocId(): int;
    public function getParameter(): string;
    public function getDescription(): string;
}