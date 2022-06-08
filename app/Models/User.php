<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

/**
* @property string $email
* @property string $password
* @property int $role_id
* @property int $login_type
* @property string $first_name
* @property string $last_name
* @property string $timezone
* @property string $more_information
* @property string $desc
* @property int $balance
* @property int $custom_rate
* @property string $api_key
* @property int $spent
* @property string $activation_key
* @property int $status
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles;

    public const MODEL_ROUTE_PERMISSION = 'user';

    public const STATUS_ACTIVE = 1;
    public const STATUS_BLOCKED = 2;
    public const STATUS_VIP = 3;

    public const ROLE_CLIENT = 2;
    public const ROLE_ADMIN = 1;

    public const ROLE_LIST = [
        self::ROLE_ADMIN => 'admin',
        self::ROLE_CLIENT => 'client',
    ];

    public const STATUS_LIST = [
        self::STATUS_ACTIVE => 'active',
        self::STATUS_BLOCKED => 'blocked',
        self::STATUS_VIP => 'vip',
    ];

    public const IP_KEY_MAP = [
        'HTTP_CLIENT_IP',
        'HTTP_X_FORWARDED_FOR',
        'HTTP_X_FORWARDED',
        'HTTP_X_CLUSTER_CLIENT_IP',
        'HTTP_FORWARDED_FOR',
        'HTTP_FORWARDED',
        'REMOTE_ADDR'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "email",
        "password",
        "role_id",
        "login_type",
        "first_name",
        "last_name",
        "timezone",
        "more_information",
        "desc",
        "balance",
        "custom_rate",
        "api_key",
        "spent",
        "activation_key",
        "status",
        "image_file"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(): Relation
    {
        return $this->hasOne(Role::class, 'id','role_id');
    }

    public function canceledPayments(): Relation
    {
        return $this->hasMany(UserCanceledPayment::class, 'user_id', 'id');
    }

    public function userPrice(): Relation
    {
        return $this->hasMany(UserPrice::class, 'user_id', 'id');
    }

    public function isAdmin(): bool
    {
        return $this->role_id === self::ROLE_ADMIN;
    }

    public function lastSession(): Relation
    {
        return $this
            ->hasOne(Session::class, 'user_id', 'id')
            ->orderBy('id', 'desc')
            ->limit(1);
    }

    public function getSpentAmount(): float
    {
        return $this->hasMany(Order::class, 'user_id', 'id')
            ->where('status', Order::ORDER_STATUS_COMPLETED)
            ->pluck('charge')
            ->sum();
    }
}
