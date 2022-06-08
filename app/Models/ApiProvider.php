<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $user_id
 * @property string $name
 * @property string $url
 * @property string $key
 * @property string $type
 * @property float $balance
 * @property string $currency_code
 * @property string $description
 * @property bool $status
 */
class ApiProvider extends Model
{
    use HasFactory;

    public const MODEL_ROUTE_PERMISSION = 'api-provider';

    protected $fillable = [
        'user_id',
        'name',
        'url',
        'key',
        'type',
        'balance',
        'currency_code',
        'description',
        'status'
    ];
}
