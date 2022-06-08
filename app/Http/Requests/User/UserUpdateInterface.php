<?php

namespace App\Http\Requests\User;

use Illuminate\Http\UploadedFile;

interface UserUpdateInterface
{
    public function getId(): int;

    public function getEmail(): ?string;

    public function getFirstName(): ?string;

    public function getLastName(): ?string;

    public function getTimezone(): ?string;

    public function getRoleId(): ?int;

    public function getPayments(): ?array;

    public function getServices(): ?array;

    public function getChangePassword(): ?string;

    public function getBalance(): ?float;

    public function getRoleName(): ?string;

    public function getDesc(): ?string;

    public function getStatus(): ?int;

    public function getMoreInformation(): ?array;

    public function getImageUrl(): string;

    public function setImageUrl(string $image_url): void;

    public function getAvatar(): ?UploadedFile;
}
