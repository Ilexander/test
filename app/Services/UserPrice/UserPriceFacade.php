<?php

namespace App\Services\UserPrice;

use App\DTO\User\UserPersonalPriceCollectionDTO;
use App\Http\Requests\UserPrice\UserPriceAllInterface;
use App\Http\Requests\UserPrice\UserPriceCreateInterface;
use App\Http\Requests\UserPrice\UserPriceDeleteInterface;
use App\Http\Requests\UserPrice\UserPriceInfoInterface;
use App\Http\Requests\UserPrice\UserPriceUpdateInterface;
use Illuminate\Support\Facades\Facade;

/**
 * @method static all(UserPriceAllInterface $all)
 * @method static info(UserPriceInfoInterface $info)
 * @method static create(UserPersonalPriceCollectionDTO $create)
 * @method static delete(UserPriceDeleteInterface $delete)
 * @method static update(UserPriceUpdateInterface $update)
 * @method static deletePricesByUserId(int $user_id)
 */
class UserPriceFacade extends Facade
{
    protected static function getFacadeAccessor() { return 'userPriceService'; }
}