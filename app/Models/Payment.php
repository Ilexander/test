<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Class Payment
 * @package App\Models
 *
 * @property string name
 * @property string image_url
 * @property string type
 * @property int min
 * @property int max
 * @property int status
 * @property int take_fee_from_user
 * @property string client_id
 * @property string secret_key
 * @property int limit
 * @property Collection currencies
 * @property PaymentBonus bonus
 */
class Payment extends Model
{
    use HasFactory;

    public const MODEL_ROUTE_PERMISSION = 'payment';

    protected $fillable = [
        'name',
        'image_url',
        'type',
        'min',
        'max',
        'status',
        'take_fee_from_user',
        'client_id',
        'secret_key',
        'limit',
    ];

    public function currencies(): Relation
    {
        return $this->hasMany('App\Models\PaymentCurrency', 'payment_id', 'id');
    }

    public function bonus(): Relation
    {
        return $this->hasOne(PaymentBonus::class, 'payment_id', 'id');
    }
}
