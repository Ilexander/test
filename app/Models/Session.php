<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Session extends Model
{
    use HasFactory;

    public const MODEL_ROUTE_PERMISSION = 'session';

    protected $fillable = [
        'user_id',
        'ip'
    ];

    public function user(): Relation
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
