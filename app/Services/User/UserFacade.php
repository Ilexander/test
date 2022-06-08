<?php

namespace App\Services\User;

use App\Http\Requests\Role\RoleInfoInterface;
use App\Http\Requests\User\UserAllInterface;
use App\Http\Requests\User\UserCreateInterface;
use App\Http\Requests\User\UserDeleteInterface;
use App\Http\Requests\User\UserInfoInterface;
use App\Http\Requests\User\UserUpdateInterface;
use Illuminate\Support\Facades\Facade;

/**
 * @method static info(UserInfoInterface $info)
 * @method static all(UserAllInterface $all)
 * @method static create(UserCreateInterface $create, RoleInfoInterface $info)
 * @method static update(UserUpdateInterface $update, RoleInfoInterface $info)
 * @method static delete(UserDeleteInterface $delete)
 * @method static list()
 */
class UserFacade extends Facade
{
    protected static function getFacadeAccessor() { return 'userService'; }
}