<?php

namespace App\Http\Requests\PaymentBonus;

interface PaymentBonusDeleteInterface
{
    public function getId(): ?int;
    public function getUserId(): int;
    public function getIds(): ?array;
    public function getStatus(): ?bool;
}
