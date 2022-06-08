<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property string $alt
 * @property string $supported_countries
 * @property bool $status
 * @property string $image_url
 */
class Language extends Model
{
    use HasFactory;

    public const MODEL_ROUTE_PERMISSION = 'language';

    protected $fillable = [
        'name',
        'alt',
        'supported_countries',
        'status',
        'image_url',
        'view'
    ];
}
