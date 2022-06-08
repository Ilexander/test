<?php

namespace App\Services\Payment\PaymentBonus;

use App\Http\Requests\PaymentBonus\PaymentBonusAllInterface;
use App\Http\Requests\PaymentBonus\PaymentBonusCreateInterface;
use App\Http\Requests\PaymentBonus\PaymentBonusDeleteInterface;
use App\Http\Requests\PaymentBonus\PaymentBonusInfoInterface;
use App\Http\Requests\PaymentBonus\PaymentBonusUpdateInterface;
use Illuminate\Support\Facades\Facade;

/**
 * @method static all(PaymentBonusAllInterface $all)
 * @method static info(PaymentBonusInfoInterface $info)
 * @method static create(PaymentBonusCreateInterface $create)
 * @method static delete(PaymentBonusDeleteInterface $delete)
 * @method static update(PaymentBonusUpdateInterface $update)
 */
class PaymentBonusFacade extends Facade
{
    protected static function getFacadeAccessor() { return 'paymentBonusService'; }
}