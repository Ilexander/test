<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public const MODEL_ROUTE_PERMISSION = 'department';

    protected $fillable = [
        'name'
    ];

    public function users()
    {
        return $this->hasMany(DepartmentUser::class, 'department_id');
    }
}
