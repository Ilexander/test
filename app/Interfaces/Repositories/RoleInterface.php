<?php

namespace App\Interfaces\Repositories;

use App\Http\Requests\Role\RoleAllInterface;
use App\Http\Requests\Role\RoleCreateInterface;
use App\Http\Requests\Role\RoleDeleteInterface;
use App\Http\Requests\Role\RoleInfoInterface;
use App\Http\Requests\Role\RoleUpdateInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface RoleInterface
 * @package App\Interfaces\Repositories
 */
interface RoleInterface
{
    /**
     * @param RoleAllInterface $all
     * @return Collection
     */
    public function all(RoleAllInterface $all): Collection;

    /**
     * @param RoleInfoInterface $info
     * @return Model
     */
    public function info(RoleInfoInterface $info): Model;

    /**
     * @param RoleCreateInterface $create
     * @return Model
     */
    public function create(RoleCreateInterface $create): Model;

    /**
     * @param RoleUpdateInterface $update
     * @return bool
     */
    public function update(RoleUpdateInterface $update): bool;

    /**
     * @param RoleDeleteInterface $delete
     * @return bool
     */
    public function delete(RoleDeleteInterface $delete): bool;
}