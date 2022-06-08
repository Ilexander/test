<?php

namespace App\Services;

use App\Http\Requests\User\UserCreateInterface;
use App\Models\User;

class UserService
{
    public function create(UserCreateInterface $create)
    {
        User::query()->create([
            "email"             => $create->getEmail(),
            "password"          => bcrypt($create->getPassword()),
            "role_id"           => User::ROLE_CLIENT,
            "first_name"        => $create->getFirstName(),
            "last_name"         => $create->getLastName(),
            "timezone"          => $create->getTimezone(),
            "status"            => User::STATUS_ACTIVE,
        ]);
    }

    public function list()
    {
        return User::query()->get();
    }
}