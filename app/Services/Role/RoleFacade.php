<?php

namespace App\Services\Role;

use App\Http\Requests\Role\RoleAllInterface;
use App\Http\Requests\Role\RoleCreateInterface;
use App\Http\Requests\Role\RoleDeleteInterface;
use App\Http\Requests\Role\RoleInfoInterface;
use App\Http\Requests\Role\RoleUpdateInterface;
use Illuminate\Support\Facades\Facade;

/**
 * Class RoleFacade
 * @package App\Services\Role
 *
 * @method static all(RoleAllInterface $all)
 * @method static info(RoleInfoInterface $info)
 * @method static create(RoleCreateInterface $create)
 * @method static delete(RoleDeleteInterface $delete)
 * @method static update(RoleUpdateInterface $update)
 */
class RoleFacade extends Facade
{
    protected static function getFacadeAccessor() { return 'roleService'; }
}