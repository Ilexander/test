<?php

namespace App\Services\User;

use App\DTO\User\UserCanceledPaymentCollectionDTO;
use Illuminate\Support\Facades\Facade;

/**
 * @method static create(UserCanceledPaymentCollectionDTO $canceledPaymentCollectionDTO)
 * @method static delete(int $user_id, int $payment_id)
 * @method static getForUser(int $user_id)
 * @method static getForPayment(int $payment_id)
 * @method static deleteForUser(int $user_id)
 * @method static deleteForPayment(int $payment_id)
 */
class UserCanceledPaymentFacade extends Facade
{
    protected static function getFacadeAccessor() { return 'UserCanceledPaymentService'; }
}