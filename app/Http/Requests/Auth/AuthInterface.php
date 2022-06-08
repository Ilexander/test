<?php

namespace App\Http\Requests\Auth;

interface AuthInterface
{
    public function getEmail(): string;

    public function getPassword(): string;
}
