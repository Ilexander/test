<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class PaymentCurrency extends Model
{
    use HasFactory;

    public const MODEL_ROUTE_PERMISSION = 'payment_currency';

    protected $fillable = [
        'payment_id',
        'currency_id'
    ];

    public function currency(): Relation
    {
        return $this->hasOne('App\Models\Currency', 'id', 'currency_id');
    }
}
