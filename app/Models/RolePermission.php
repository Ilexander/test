<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    use HasFactory;

    public const MODEL_ROUTE_PERMISSION = 'role_permission';

    protected $table = 'role_has_permissions';

    protected $fillable = [
        'permission_id',
        'role_id'
    ];
}
