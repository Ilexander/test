<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * @property int payment_id
 * @property int bonus_start_funds
 * @property int percentage
 * @property bool status
 */
class PaymentBonus extends Model
{
    use HasFactory;

    public const MODEL_ROUTE_PERMISSION = 'payment_bonus';

    protected $fillable = [
        "payment_id",
        "bonus_start_funds",
        "percentage",
        "status",
    ];

    public function payment(): Relation
    {
        return $this->hasOne(Payment::class, 'id', 'payment_id');
    }
}
