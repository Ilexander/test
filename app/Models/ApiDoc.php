<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * @property string $title
 * @property string|null $description
 * @property string|null $response
 */
class ApiDoc extends Model
{
    use HasFactory;

    public const MODEL_ROUTE_PERMISSION = 'api-doc';

    protected $fillable = [
        'title',
        'description',
        'response',
    ];

    public function params(): Relation
    {
        return $this->hasMany(ApiDocParams::class, 'api_doc_id', 'id');
    }
}
