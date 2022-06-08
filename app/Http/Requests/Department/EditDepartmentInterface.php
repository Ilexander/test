<?php

namespace App\Http\Requests\Department;

interface EditDepartmentInterface
{
    public function getId(): int;

    public function getName(): string;

    public function getMembers(): ?array;
}