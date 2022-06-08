<?php

namespace App\Services\Permission;

use App\Repositories\Permission\PermissionRepository;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Permission;

class PermissionServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('permissionService', function($app) {
            return new PermissionService(
                $app->make('App\Interfaces\Repositories\PermissionInterface')
            );
        });

        $this->app->bind('App\Interfaces\Repositories\PermissionInterface', function($app) {
            return new PermissionRepository(new Permission());
        });
    }
}