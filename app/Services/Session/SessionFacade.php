<?php

namespace App\Services\Session;

use App\Http\Requests\Session\SessionAllInterface;
use Illuminate\Support\Facades\Facade;

/**
 * @method static all(SessionAllInterface $all)
 * @method static create(int $user_id, string $ip)
 */
class SessionFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'sessionService';
    }
}