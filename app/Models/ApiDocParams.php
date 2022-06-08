<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int api_doc_id
 * @property string parameter
 * @property string description
 */
class ApiDocParams extends Model
{
    use HasFactory;

    public const MODEL_ROUTE_PERMISSION = 'api-doc-params';

    protected $fillable = [
        'api_doc_id',
        'parameter',
        'description',
    ];
}
