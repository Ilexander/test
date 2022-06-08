<?php

namespace App\Http\Requests\Role;

interface RoleCreateInterface
{
    public function getName(): string;

    public function getPermission(): ?array;
}