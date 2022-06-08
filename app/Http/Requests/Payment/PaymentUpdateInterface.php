<?php

namespace App\Http\Requests\Payment;

use Illuminate\Http\UploadedFile;

interface PaymentUpdateInterface
{
    public function getId(): int;
    public function getName(): ?string;
    public function getImage(): ?UploadedFile;
    public function getType(): ?string;
    public function getMin(): ?int;
    public function getMax(): ?int;
    public function getStatus(): ?bool;
    public function getTakeFeeFromUser(): ?bool;
    public function getClientId(): ?string;
    public function getSecretKey(): ?string;
    public function getLimit(): ?int;
    public function setImageUrl(string $imageUrl): void;
    public function getImageUrl(): ?string;
    public function getCurrency(): ?array;
}