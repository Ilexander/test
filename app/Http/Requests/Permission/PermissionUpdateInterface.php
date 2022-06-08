<?php

namespace App\Http\Requests\Permission;

interface PermissionUpdateInterface
{
    public function getId(): int;
    public function getName(): string;
}