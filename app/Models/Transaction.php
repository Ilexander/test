<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Class Transaction
 * @package App\Models
 *
 * @property string payer_email
 * @property int payment_id
 * @property string transaction_id
 * @property float txn_fee
 * @property int amount
 * @property int status
 * @property string system_hash
 * @property string note
 * @property int currency_id
 * @property int user_id
 * @property Payment payment
 * @property User user
 * @property Currency currency
 */
class Transaction extends Model
{
    use HasFactory;

    public const MODEL_ROUTE_PERMISSION = 'transaction';

    public const STATUS_NEW = 0;
    public const STATUS_FAILED = 1;
    public const STATUS_SUCCESS = 2;

    public const STATUS_LIST = [
        self::STATUS_NEW => "NEW",
        self::STATUS_FAILED => "FAILED",
        self::STATUS_SUCCESS => "SUCCESS",
    ];

    protected $fillable = [
        'payer_email',
        'payment_id',
        'transaction_id',
        'txn_fee',
        'amount',
        'status',
        'system_hash',
        'currency_id',
        'user_id',
        'note'
    ];

    public function payment():Relation
    {
        return $this
            ->hasOne('App\Models\Payment', 'id', 'payment_id')
            ->select(
                [
                    'id',
                    'name',
                    'image_url',
                    'type',
                    'min',
                    'max',
                    'status',
                    'take_fee_from_user',
                    'limit'
                ]
            );
    }

    public function currency():Relation
    {
        return $this->hasOne('App\Models\Currency', 'id', 'currency_id');
    }

    public function bonus(): Relation
    {
        return $this->hasOne('App\Models\TransactionBonus', 'transaction_id', 'id');
    }
}
