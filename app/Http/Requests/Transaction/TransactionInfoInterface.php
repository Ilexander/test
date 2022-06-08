<?php

namespace App\Http\Requests\Transaction;

interface TransactionInfoInterface
{
    public function getId(): int;
    public function getUserId(): int;
}