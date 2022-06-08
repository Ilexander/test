<?php

namespace App\Http\Requests\Transaction;

interface TransactionAllInterface
{
    public function getUserId(): ?int;

    public function getStatus(): ?int;

    public function getUserFilter(): ?string;

    public function getTransactionIdFilter(): ?string;

    public function getPaymentFilter(): ?int;

    public function getAmountFilter(): ?float;

    public function getTransactionFeeFilter(): ?string;

    public function getIdFilter(): ?int;

    public function getLimit(): ?int;
}
