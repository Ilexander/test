<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int user_id
 * @property int payment_id
 */
class UserCanceledPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_id'
    ];
}
