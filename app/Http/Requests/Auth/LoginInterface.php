<?php

namespace App\Http\Requests\Auth;

interface LoginInterface
{
    public function getEmail(): ?string;

    public function getPassword(): ?string;

    public function getAutologin(): ?bool;
}
