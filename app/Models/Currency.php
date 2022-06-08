<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Currency
 * @package App\Models
 *
 * @property string name
 * @property string description
 */
class Currency extends Model
{
    use HasFactory;

    public const MODEL_ROUTE_PERMISSION = 'currency';

    protected $fillable = [
        'name',
        'description',
    ];
}
