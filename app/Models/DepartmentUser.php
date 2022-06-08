<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentUser extends Model
{
    use HasFactory;

    public const MODEL_ROUTE_PERMISSION = 'department_user';

    protected $fillable = [
        'user_id',
        'department_id'
    ];

    public $timestamps = null;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
