<?php

namespace App\Services\Permission;

use App\Http\Requests\Permission\PermissionAllInterface;
use App\Http\Requests\Permission\PermissionCreateInterface;
use App\Http\Requests\Permission\PermissionDeleteInterface;
use App\Http\Requests\Permission\PermissionInfoInterface;
use App\Http\Requests\Permission\PermissionUpdateInterface;
use Illuminate\Support\Facades\Facade;

/**
 * Class PermissionFacade
 * @package App\Services\Permission
 *
 * @method static all()
 * @method static list(PermissionAllInterface $all)
 * @method static info(PermissionInfoInterface $info)
 * @method static create(PermissionCreateInterface $create)
 * @method static delete(PermissionDeleteInterface $delete)
 * @method static update(PermissionUpdateInterface $update)
 */
class PermissionFacade extends Facade
{
    protected static function getFacadeAccessor() { return 'permissionService'; }
}