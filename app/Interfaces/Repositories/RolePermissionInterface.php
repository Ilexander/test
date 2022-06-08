<?php

namespace App\Interfaces\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Role;

interface RolePermissionInterface
{
    public function getRolePermissions(int $roleId): Collection;

    public function getPermissionRoles(int $permissionId): Collection;

    public function syncPermissionsToRole(Role $role, Collection $permissions): void;

    public function removeRolePermissions(int $roleId): void;

    public function removePermissionRoles(int $permissionId): void;
}