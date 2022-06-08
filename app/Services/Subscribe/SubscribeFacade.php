<?php

namespace App\Services\Subscribe;

use App\Http\Requests\Subscribe\SubscribeAllInterface;
use App\Http\Requests\Subscribe\SubscribeCreateInterface;
use App\Http\Requests\Subscribe\SubscribeDeleteInterface;
use App\Http\Requests\Subscribe\SubscribeInfoInterface;
use App\Http\Requests\Subscribe\SubscribeUpdateInterface;
use Illuminate\Support\Facades\Facade;

/**
 * @method static all(SubscribeAllInterface $all)
 * @method static create(SubscribeCreateInterface $create)
 * @method static info(SubscribeInfoInterface $info)
 * @method static update(SubscribeUpdateInterface $update)
 * @method static delete(SubscribeDeleteInterface $delete)
 */
class SubscribeFacade extends Facade
{
    protected static function getFacadeAccessor() { return 'subscribeService'; }
}