<?php

namespace App\Http\Requests\Currency;

interface CurrencyUpdateInterface
{
    public function getId(): int;
    public function getName(): string;
    public function getDescription(): string;
}