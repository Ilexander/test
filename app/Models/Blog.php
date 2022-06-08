<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * @property int user_id
 * @property string title
 * @property string category
 * @property string url_slug
 * @property string image_url
 * @property string content
 * @property string meta_keywords
 * @property string meta_description
 * @property int sort
 * @property boolean status
 */
class Blog extends Model
{
    use HasFactory;

    public const MODEL_ROUTE_PERMISSION = 'blog';

    public const DEFAULT_LANGUAGE = 'English';

    protected $fillable = [
        "user_id",
        "title",
        "category",
        "url_slug",
        "image_url",
        "content",
        "meta_keywords",
        "meta_description",
        "sort",
        "status",
    ];

    public function translation(): Relation
    {
        return $this->hasMany(Translation::class, 'item_id', 'id')
            ->where('item_type', Blog::class);
    }
}
