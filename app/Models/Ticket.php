<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * @property int $user_id
 * @property string $subject
 * @property string $description
 * @property boolean $status
 */
class Ticket extends Model
{
    use HasFactory;

    public const MODEL_ROUTE_PERMISSION = 'ticket';

    public const OPEN_STATUS = 1;
    public const PROCESS_STATUS = 2;
    public const CLOSE_STATUS = 3;
    public const WAIT_FOR_ADMIN_ANSWER = 5;
    public const WAIT_FOR_USER_ANSWER = 4;
    public const UNREAD_STATUS = 6;
    public const ANSWERED_STATUS = 7;

    public const TICKET_CHECK_STATUS_LIST = [
        self::OPEN_STATUS => 'open',
        self::PROCESS_STATUS => 'process',
        self::CLOSE_STATUS => 'close',
        self::WAIT_FOR_ADMIN_ANSWER => 'wait for admin',
        self::WAIT_FOR_USER_ANSWER => 'wait for user',
    ];

    public const TICKET_STATUS_LIST = [
        self::OPEN_STATUS => 'open',
        self::PROCESS_STATUS => 'process',
        self::CLOSE_STATUS => 'close',
        self::UNREAD_STATUS => 'unread',
        self::ANSWERED_STATUS => 'answered',
    ];

    protected $fillable = [
        'user_id',
        'subject',
        'description',
        'status',
        'entity_type',
        'entity_id',
        'is_important'
    ];

    public function user(): Relation
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
