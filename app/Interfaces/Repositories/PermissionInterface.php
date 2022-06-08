<?php

namespace App\Interfaces\Repositories;

use App\Http\Requests\Permission\PermissionAllInterface;
use App\Http\Requests\Permission\PermissionCreateInterface;
use App\Http\Requests\Permission\PermissionDeleteInterface;
use App\Http\Requests\Permission\PermissionInfoInterface;
use App\Http\Requests\Permission\PermissionUpdateInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface PermissionInterface
{
    /**
     * @param PermissionAllInterface $list
     * @return Collection
     */
    public function list(PermissionAllInterface $list): Collection;

    /**
     * @param PermissionInfoInterface $info
     * @return Model
     */
    public function info(PermissionInfoInterface $info): Model;

    /**
     * @param PermissionCreateInterface $create
     * @return bool
     */
    public function create(PermissionCreateInterface $create): bool;

    /**
     * @param PermissionDeleteInterface $delete
     * @return bool
     */
    public function delete(PermissionDeleteInterface $delete): bool;

    /**
     * @param PermissionUpdateInterface $update
     * @return bool
     */
    public function update(PermissionUpdateInterface $update): bool;

    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * @param array $permissionIds
     * @return Collection
     */
    public function getByIds(array $permissionIds): Collection;
}