<?php

namespace App\Http\Requests\User;

interface UserCreateInterface
{
    public function getEmail(): string;

    public function getFirstName(): string;

    public function getLastName(): ?string;

    public function getPassword(): string;

    public function getTimezone(): string;

    public function getRoleId(): int;

    public function getPayments(): ?array;

    public function getServices(): ?array;
}
