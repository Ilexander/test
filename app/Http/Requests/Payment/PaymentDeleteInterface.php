<?php

namespace App\Http\Requests\Payment;

interface PaymentDeleteInterface
{
    public function getId(): ?int;
    public function getIds(): ?array;
    public function getStatus(): ?bool;
}
