<?php

namespace App\Services\Order;

use App\Http\Requests\Order\OrderAllInterface;
use App\Http\Requests\Order\OrderCreateInterface;
use App\Http\Requests\Order\OrderDeleteInterface;
use App\Http\Requests\Order\OrderInfoInterface;
use App\Http\Requests\Order\OrderUpdateInterface;
use Illuminate\Support\Facades\Facade;

/**
 * @method static all(OrderAllInterface $all)
 * @method static info(OrderInfoInterface $info)
 * @method static create(OrderCreateInterface $create)
 * @method static update(OrderUpdateInterface $update)
 * @method static delete(OrderDeleteInterface $delete)
 * @method static profitStatistic()
 * @method static statusesStatistic(?int $user_id)
 */
class OrderFacade extends Facade
{
    protected static function getFacadeAccessor() { return 'orderService'; }
}