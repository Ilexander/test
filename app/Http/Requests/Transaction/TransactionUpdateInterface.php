<?php

namespace App\Http\Requests\Transaction;

interface TransactionUpdateInterface
{
    public function getId(): int;
    public function getPayerEmail(): ?string;
    public function getPaymentId(): ?int;
    public function getTransactionId(): ?string;
    public function getTxnFee(): ?int;
    public function getAmount(): ?int;
    public function getStatus(): ?int;
    public function getSystemHash(): ?string;
    public function getCurrencyId(): ?int;
    public function getUserId(): ?int;
    public function getNote(): ?string;
}
