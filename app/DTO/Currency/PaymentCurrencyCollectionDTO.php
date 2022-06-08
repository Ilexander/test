<?php

namespace App\DTO\Currency;

class PaymentCurrencyCollectionDTO
{
    private array $list;

    public function __construct()
    {
        $this->list = [];
    }

    public function add(PaymentCurrencyItemDTO $currencyItemDTO)
    {
        $this->list[] = $currencyItemDTO;
    }

    public function list(): array
    {
        return $this->list;
    }
}
