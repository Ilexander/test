<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * @property int user_id
 * @property int service_id
 * @property float service_price
 */
class UserPrice extends Model
{
    use HasFactory;

    public const MODEL_ROUTE_PERMISSION = 'user_price';

    protected $fillable = [
        'user_id',
        'service_id',
        'service_price'
    ];

    public function user(): Relation
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function service(): Relation
    {
        return $this->hasOne(Service::class, 'id', 'service_id');
    }
}
