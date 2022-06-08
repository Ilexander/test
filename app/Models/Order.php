<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $type
 * @property int|null $category_id
 * @property int|null $service_id
 * @property int|null $main_order_id
 * @property string|null $service_type
 * @property int|null $api_provider_id
 * @property string|null $api_service_id
 * @property int|null $api_order_id
 * @property string|null $link
 * @property string|null $quantity
 * @property string|null $usernames
 * @property string|null $username
 * @property string|null $hashtags
 * @property string|null $hashtag
 * @property string|null $media
 * @property string|null $comments
 * @property int|null $sub_posts
 * @property int|null $sub_min
 * @property int|null $sub_max
 * @property int|null $sub_delay
 * @property string|null $sub_expiry
 * @property string|null $sub_response_orders
 * @property string|null $sub_response_posts
 * @property string|null $sub_status
 * @property float|null $charge
 * @property float|null $formal_charge
 * @property float|null $profit
 * @property string|null $status
 * @property string|null $start_counter
 * @property string|null $remains
 * @property bool|null $is_drip_feed
 * @property int|null $runs
 * @property int|null $interval
 * @property string|null $dripfeed_quantity
 * @property string|null $note
 * @property int $user_id
 */
class Order extends Model
{
    use HasFactory;

    public const MODEL_ROUTE_PERMISSION = 'order';

    public const ORDER_TYPE_API = 'api';
    public const ORDER_TYPE_DIRECT = 'direct';

    public const ORDER_TYPE_LIST = [
        self::ORDER_TYPE_API,
        self::ORDER_TYPE_DIRECT,
    ];

    public const ORDER_SUB_STATUS_ACTIVE = 'Active';
    public const ORDER_SUB_STATUS_PAUSED = 'Paused';
    public const ORDER_SUB_STATUS_COMPLETED = 'Completed';
    public const ORDER_SUB_STATUS_EXPIRED = 'Expired';
    public const ORDER_SUB_STATUS_CANCELED = 'Canceled';

    public const ORDER_SUB_STATUS_LIST = [
        self::ORDER_SUB_STATUS_ACTIVE,
        self::ORDER_SUB_STATUS_PAUSED,
        self::ORDER_SUB_STATUS_COMPLETED,
        self::ORDER_SUB_STATUS_EXPIRED,
        self::ORDER_SUB_STATUS_CANCELED,
    ];

    public const ORDER_STATUS_ACTIVE = 'active';
    public const ORDER_STATUS_COMPLETED = 'completed';
    public const ORDER_STATUS_PROCESSING = 'processing';
    public const ORDER_STATUS_IN_PROGRESS = 'inprogress';
    public const ORDER_STATUS_PENDING = 'pending';
    public const ORDER_STATUS_PARTIAL = 'partial';
    public const ORDER_STATUS_CANCELED = 'canceled';
    public const ORDER_STATUS_REFUNDED = 'refunded';
    public const ORDER_STATUS_AWAITING = 'awaiting';
    public const ORDER_STATUS_ERROR = 'error';
    public const ORDER_STATUS_FAIL = 'fail';

    public const ORDER_STATUS_LIST = [
        self::ORDER_STATUS_ACTIVE,
        self::ORDER_STATUS_COMPLETED,
        self::ORDER_STATUS_PROCESSING,
        self::ORDER_STATUS_IN_PROGRESS,
        self::ORDER_STATUS_PENDING,
        self::ORDER_STATUS_PARTIAL,
        self::ORDER_STATUS_CANCELED,
        self::ORDER_STATUS_REFUNDED,
        self::ORDER_STATUS_AWAITING,
        self::ORDER_STATUS_ERROR,
//        self::ORDER_STATUS_FAIL,
    ];

    public const ORDER_USER_STATUS_LIST = [
        self::ORDER_STATUS_PENDING,
        self::ORDER_STATUS_PROCESSING,
        self::ORDER_STATUS_IN_PROGRESS,
        self::ORDER_STATUS_COMPLETED,
        self::ORDER_STATUS_PARTIAL,
        self::ORDER_STATUS_CANCELED,
        self::ORDER_STATUS_REFUNDED,
        self::ORDER_STATUS_AWAITING,
    ];

    public const ORDER_API_STATUS_PROCESS = 'progress';

    public const ORDER_TYPE_SINGLE = 'single';
    public const ORDER_TYPE_MASS = 'mass';

    protected $fillable = [
        "type",
        "category_id",
        "service_id",
        "main_order_id",
        "service_type",
        "api_provider_id",
        "api_service_id",
        "api_order_id",
        "user_id",
        "link",
        "quantity",
        "usernames",
        "username",
        "hashtags",
        "hashtag",
        "media",
        "comments",
        "sub_posts",
        "sub_min",
        "sub_max",
        "sub_delay",
        "sub_expiry",
        "sub_response_orders",
        "sub_response_posts",
        "sub_status",
        "charge",
        "formal_charge",
        "profit",
        "status",
        "start_counter",
        "remains",
        "is_drip_feed",
        "runs",
        "interval",
        "dripfeed_quantity",
        "note",
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function service()
    {
        return $this->hasOne(Service::class, 'id', 'service_id');
    }
}
