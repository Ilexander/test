<?php

namespace App\Repositories\Permission;

use App\Http\Requests\Permission\PermissionAllInterface;
use App\Http\Requests\Permission\PermissionCreateInterface;
use App\Http\Requests\Permission\PermissionDeleteInterface;
use App\Http\Requests\Permission\PermissionInfoInterface;
use App\Http\Requests\Permission\PermissionUpdateInterface;
use App\Interfaces\Repositories\PermissionInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class PermissionRepository implements PermissionInterface
{
    private Permission $repo;

    /**
     * PermissionRepository constructor.
     * @param Permission $repo
     */
    public function __construct(Permission $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param PermissionAllInterface $list
     * @return Collection
     */
    public function list(PermissionAllInterface $list): Collection
    {
        return $this->repo->newQuery()->get();
    }

    /**
     * @param PermissionInfoInterface $info
     * @return Model
     */
    public function info(PermissionInfoInterface $info): Model
    {
        return $this
            ->repo
            ->newQuery()
            ->where('id', $info->getId())
            ->first();
    }

    /**
     * @param PermissionCreateInterface $create
     * @return bool
     */
    public function create(PermissionCreateInterface $create): bool
    {
        try {
            $this
                ->repo
                ->newQuery()
                ->create([
                    'name' => $create->getName()
                ]);

            return true;
        } catch (\Exception $exception) {

            return false;
        }
    }

    /**
     * @param PermissionDeleteInterface $delete
     * @return bool
     */
    public function delete(PermissionDeleteInterface $delete): bool
    {
        return $this
            ->repo
            ->newQuery()
            ->where('id', $delete->getId())
            ->delete();
    }

    /**
     * @param PermissionUpdateInterface $update
     * @return bool
     */
    public function update(PermissionUpdateInterface $update): bool
    {
        return $this
            ->repo
            ->newQuery()
            ->where('id', $update->getId())
            ->update([
                'name' => $update->getName()
            ]);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->repo->newQuery()->get();
    }

    /**
     * @param array $permissionIds
     * @return Collection
     */
    public function getByIds(array $permissionIds): Collection
    {
        return $this
            ->repo
            ->newQuery()
            ->whereIn('id', $permissionIds)
            ->get();
    }
}