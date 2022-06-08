<?php

namespace App\Http\Requests\Department;

interface AddDepartmentInterface
{
    public function getName(): string;

    public function getMembers(): ?array;
}