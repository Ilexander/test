<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * @property int $user_id
 * @property int $ticket_id
 * @property string $message
 * @property boolean $is_read
 */
class TicketMessage extends Model
{
    use HasFactory;

    public const MODEL_ROUTE_PERMISSION = 'ticket_message';

    protected $fillable = [
        'user_id',
        'ticket_id',
        'message',
        'is_read'
    ];

    public function user(): Relation
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
