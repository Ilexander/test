<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $ip
 * @property string $country_code
 */
class Subscribe extends Model
{
    use HasFactory;

    public const MODEL_ROUTE_PERMISSION = 'subscribe';

    protected $fillable = [
        "first_name",
        "last_name",
        "email",
        "ip",
        "country_code",
    ];
}
