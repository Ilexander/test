<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Class Category
 * @package App\Models
 *
 * @property integer user_id
 * @property string name
 * @property string description
 * @property string image_url
 * @property integer sort
 * @property integer status
 * @property User user
 */
class Category extends Model
{
    use HasFactory;

    public const MODEL_ROUTE_PERMISSION = 'category';

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'image_url',
        'sort',
        'status',
    ];

    public function user(): Relation
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function services(): Relation
    {
        return $this->hasMany('App\Models\Service', 'category_id', 'id');
    }
}
