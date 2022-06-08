<?php

namespace App\Http\Requests\Role;

interface RoleUpdateInterface
{
    public function getId(): int;

    public function getName(): string;

    public function getPermission(): ?array;
}