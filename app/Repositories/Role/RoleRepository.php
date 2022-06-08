<?php

namespace App\Repositories\Role;

use App\Http\Requests\Role\RoleAllInterface;
use App\Http\Requests\Role\RoleCreateInterface;
use App\Http\Requests\Role\RoleDeleteInterface;
use App\Http\Requests\Role\RoleInfoInterface;
use App\Http\Requests\Role\RoleUpdateInterface;
use App\Interfaces\Repositories\RoleInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class RoleRepository implements RoleInterface
{
    private Role $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function all(RoleAllInterface $all): Collection
    {
        return $this->role->newQuery()->get();
    }

    public function info(RoleInfoInterface $info): Model
    {
        return $this
            ->role
            ->newQuery()
            ->with('permissions')
            ->where('id', $info->getId())
            ->first();
    }

    public function create(RoleCreateInterface $create): Model
    {
        return $this->role->newQuery()->firstOrCreate([
            'name' => $create->getName()
        ]);
    }

    public function update(RoleUpdateInterface $update): bool
    {
        return $this
            ->role
            ->newQuery()
            ->where('id', $update->getId())
            ->update([
                'name' => $update->getName()
            ]);
    }

    public function delete(RoleDeleteInterface $delete): bool
    {
        return $this
            ->role
            ->newQuery()
            ->where('id', $delete->getId())
            ->delete();
    }
}