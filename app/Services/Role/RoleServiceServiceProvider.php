<?php

namespace App\Services\Role;

use App\Interfaces\Repositories\PermissionInterface;
use App\Models\RolePermission;
use App\Repositories\Role\RolePermissionRepository;
use App\Repositories\Role\RoleRepository;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('roleService', function($app) {
            return new RoleService(
                $app->make('App\Interfaces\Repositories\RoleInterface'),
                $app->make('App\Interfaces\Repositories\PermissionInterface'),
                $app->make('App\Interfaces\Repositories\RolePermissionInterface')
            );
        });

        $this->app->bind('App\Interfaces\Repositories\RoleInterface', function($app) {
            return new RoleRepository(new Role());
        });

        $this->app->bind('App\Interfaces\Repositories\RolePermissionInterface', function($app) {
            return new RolePermissionRepository(new RolePermission(), new Role(), new Permission());
        });
    }
}