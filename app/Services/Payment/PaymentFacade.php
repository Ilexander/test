<?php

namespace App\Services\Payment;

use App\Http\Requests\Payment\PaymentAllInterface;
use App\Http\Requests\Payment\PaymentCreateInterface;
use App\Http\Requests\Payment\PaymentDeleteInterface;
use App\Http\Requests\Payment\PaymentInfoInterface;
use App\Http\Requests\Payment\PaymentUpdateInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * Class PaymentFacade
 * @package App\Services\Payment
 *
 * @method static add(PaymentCreateInterface $create)
 * @method static update(PaymentUpdateInterface $update)
 * @method static delete(PaymentDeleteInterface $delete)
 * @method static info(PaymentInfoInterface $info)
 * @method static list(PaymentAllInterface $all)
 * @method static checkAmountValid(int $paymentId, int $amount)
 * @method static formResponseCollection(Collection $payments)
 */
class PaymentFacade extends Facade
{
    protected static function getFacadeAccessor() { return 'paymentService'; }
}
