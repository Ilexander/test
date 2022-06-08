<?php

namespace App\Services\Currency;

use App\Http\Requests\Currency\CurrencyAllInterface;
use App\Http\Requests\Currency\CurrencyCreateInterface;
use App\Http\Requests\Currency\CurrencyDeleteInterface;
use App\Http\Requests\Currency\CurrencyInfoInterface;
use App\Http\Requests\Currency\CurrencyUpdateInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * Class CurrencyFacade
 * @package App\Services\Currency
 *
 * @method static add(CurrencyCreateInterface $create)
 * @method static delete(CurrencyDeleteInterface $delete)
 * @method static update(CurrencyUpdateInterface $update)
 * @method static info(CurrencyInfoInterface $info)
 * @method static all(CurrencyAllInterface $all)
 * @method static list()
 */
class CurrencyFacade extends Facade
{
    protected static function getFacadeAccessor() { return 'currencyService'; }
}