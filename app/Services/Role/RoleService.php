<?php

namespace App\Services\Role;

use App\Http\Requests\Role\RoleAllInterface;
use App\Http\Requests\Role\RoleCreateInterface;
use App\Http\Requests\Role\RoleDeleteInterface;
use App\Http\Requests\Role\RoleInfoInterface;
use App\Http\Requests\Role\RoleInfoRequest;
use App\Http\Requests\Role\RoleUpdateInterface;
use App\Interfaces\Repositories\PermissionInterface;
use App\Interfaces\Repositories\RoleInterface;
use App\Repositories\Role\RolePermissionRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

/**
 * Class RoleService
 * @package App\Services\Role
 */
class RoleService
{
    private RoleInterface $roleRepo;
    private PermissionInterface $permissionRepo;
    private RolePermissionRepository $rolePermissionRepo;

    /**
     * RoleService constructor.
     * @param RoleInterface $roleRepo
     * @param PermissionInterface $permissionRepo
     * @param RolePermissionRepository $rolePermissionRepo
     */
    public function __construct(
        RoleInterface $roleRepo,
        PermissionInterface $permissionRepo,
        RolePermissionRepository $rolePermissionRepo
    ) {
        $this->roleRepo = $roleRepo;
        $this->permissionRepo = $permissionRepo;
        $this->rolePermissionRepo = $rolePermissionRepo;
    }

    /**
     * @param RoleAllInterface $all
     * @return Collection
     */
    public function all(RoleAllInterface $all): Collection
    {
        return $this->roleRepo->all($all);
    }

    /**
     * @param RoleInfoInterface $info
     * @return Model
     */
    public function info(RoleInfoInterface $info): Model
    {
        return $this->roleRepo->info($info);
    }

    /**
     * @param RoleCreateInterface $create
     * @return Model
     */
    public function create(RoleCreateInterface $create): Model
    {
        /** @var Role $role */
        $role = $this->roleRepo->create($create);

        $this->setPermissions($create->getPermission(), $role);

        return $role;
    }

    /**
     * @param RoleDeleteInterface $delete
     * @return bool
     */
    public function delete(RoleDeleteInterface $delete): bool
    {
        return $this->roleRepo->delete($delete);
    }

    /**
     * @param RoleUpdateInterface $update
     * @return bool
     */
    public function update(RoleUpdateInterface $update): bool
    {
        if (!$this->roleRepo->update($update)) {
            return false;
        }

        $request = new RoleInfoRequest();
        $request->merge([
            'id' => $update->getId()
        ]);

        /** @var Role $role */
        $role = $this->roleRepo->info($request);

        $this->setPermissions($update->getPermission(), $role);

        return true;
    }

    private function setPermissions(?array $permissions, Role $role)
    {
        if ($permissions && !empty($permissions)) {
            $permissions = $this->permissionRepo->getByIds(array_unique($permissions));
            $this->rolePermissionRepo->removeRolePermissions($role->id);
            $this->rolePermissionRepo->syncPermissionsToRole($role, $permissions);
        }
    }
}