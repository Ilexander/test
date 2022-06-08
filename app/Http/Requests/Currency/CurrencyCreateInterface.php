<?php

namespace App\Http\Requests\Currency;

interface CurrencyCreateInterface
{
    public function getName(): string;
    public function getDescription(): string;
}