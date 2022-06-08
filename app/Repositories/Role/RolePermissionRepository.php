<?php

namespace App\Repositories\Role;

use App\Interfaces\Repositories\RolePermissionInterface;
use App\Models\RolePermission;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionRepository implements RolePermissionInterface
{
    private RolePermission $rolePermission;
    private Role $role;
    private Permission $permission;

    public function __construct(
        RolePermission $rolePermission,
        Role $role,
        Permission $permission
    ) {
        $this->rolePermission = $rolePermission;
        $this->role = $role;
        $this->permission = $permission;
    }

    public function getRolePermissions(int $roleId): Collection
    {
        return $this
            ->rolePermission
            ->newQuery()
            ->where('role_id', $roleId)
            ->get();
    }

    public function getPermissionRoles(int $permissionId): Collection
    {
        return $this
            ->rolePermission
            ->newQuery()
            ->where('permission_id', $permissionId)
            ->get();
    }

    public function syncPermissionsToRole(Role $role, Collection $permissions): void
    {
        $role->syncPermissions($permissions);
    }

    public function removeRolePermissions(int $roleId): void
    {
        /** @var Role $role */
        $role = $this->role->newQuery()->where('id', $roleId)->first();

        $permissionIds = $this
            ->rolePermission
            ->newQuery()
            ->where("role_id", $roleId)
            ->get()
            ->pluck('permission_id')
            ->toArray();

        if (!empty($permissionIds)) {
            $permissions = $this->permission->newQuery()->whereIn('id', $permissionIds)->get();

            foreach ($permissions as $permission) {
                $role->revokePermissionTo($permission);
            }
        }
    }

    public function removePermissionRoles(int $permissionId): void
    {
        /** @var Permission $permission */
        $permission = $this->permission->newQuery()->where('id', $permissionId)->first();

        $roleIds = $this
            ->rolePermission
            ->newQuery()
            ->where("permission_id", $permissionId)
            ->get()
            ->pluck('role_id')
            ->toArray();

        if (!empty($roleIds)) {
            $roles = $this->role->newQuery()->whereIn('id', $roleIds)->get();

            foreach ($roles as $role) {
                $permission->removeRole($role);
            }
        }
    }
}