<?php

namespace App\Services\Permission;

use App\Http\Requests\Permission\PermissionAllInterface;
use App\Http\Requests\Permission\PermissionCreateInterface;
use App\Http\Requests\Permission\PermissionDeleteInterface;
use App\Http\Requests\Permission\PermissionInfoInterface;
use App\Http\Requests\Permission\PermissionUpdateInterface;
use App\Interfaces\Repositories\PermissionInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PermissionService
 * @package App\Services\Permission
 */
class PermissionService
{
    private PermissionInterface $repo;

    /**
     * PermissionService constructor.
     * @param PermissionInterface $repo
     */
    public function __construct(PermissionInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param PermissionAllInterface $all
     * @return Collection
     */
    public function list(PermissionAllInterface $all): Collection
    {
        return $this->repo->list($all);
    }

    /**
     * @param PermissionInfoInterface $info
     * @return Model
     */
    public function info(PermissionInfoInterface $info): Model
    {
        return $this->repo->info($info);
    }

    /**
     * @param PermissionCreateInterface $create
     * @return bool
     */
    public function create(PermissionCreateInterface $create): bool
    {
        return $this->repo->create($create);
    }

    /**
     * @param PermissionDeleteInterface $delete
     * @return bool
     */
    public function delete(PermissionDeleteInterface $delete): bool
    {
        return $this->repo->delete($delete);
    }

    /**
     * @param PermissionUpdateInterface $update
     * @return bool
     */
    public function update(PermissionUpdateInterface $update): bool
    {
        return $this->repo->update($update);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->repo->all();
    }
}