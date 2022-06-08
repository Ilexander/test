<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * @property int $user_id
 * @property int $category_id
 * @property string $name
 * @property string $desc
 * @property int $price
 * @property int $original_price
 * @property int $min
 * @property int $max
 * @property string $add_type
 * @property string $type
 * @property string $api_service_id
 * @property int $api_provider_id
 * @property boolean $dripfeed
 * @property boolean $status
 * @property Category category
 */
class Service extends Model
{
    use HasFactory;

    public const MODEL_ROUTE_PERMISSION = 'service';

    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'desc',
        'price',
        'original_price',
        'min',
        'max',
        'add_type',
        'type',
        'api_service_id',
        'api_provider_id',
        'dripfeed',
        'status',
    ];

    public function category(): Relation
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function apiProvider(): Relation
    {
        return $this->hasOne(ApiProvider::class, 'id', 'api_provider_id');
    }
}
