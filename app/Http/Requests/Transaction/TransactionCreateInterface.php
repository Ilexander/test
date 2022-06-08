<?php

namespace App\Http\Requests\Transaction;

interface TransactionCreateInterface
{
    public function getPaymentId(): int;
    public function getAmount(): int;
    public function getUserId(): int;
    public function getCurrency(): ?int;
}