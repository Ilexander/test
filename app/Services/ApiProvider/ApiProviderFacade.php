<?php

namespace App\Services\ApiProvider;

use App\Http\Requests\ApiProvider\ApiProviderAllInterface;
use App\Http\Requests\ApiProvider\ApiProviderCreateInterface;
use App\Http\Requests\ApiProvider\ApiProviderDeleteInterface;
use App\Http\Requests\ApiProvider\ApiProviderInfoInterface;
use App\Http\Requests\ApiProvider\ApiProviderUpdateInterface;
use App\Models\ApiProvider;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @method static list(ApiProviderAllInterface $all)
 * @method static info(ApiProviderInfoInterface $info)
 * @method static services(ApiProviderInfoInterface $info)
 * @method static create(ApiProviderCreateInterface $create)
 * @method static update(ApiProviderUpdateInterface $update)
 * @method static delete(ApiProviderDeleteInterface $delete)
 * @method static formResponseCollection(Collection $apiProviders)
 * @method static formResponseItem(ApiProvider $item)
 */
class ApiProviderFacade extends Facade
{
    protected static function getFacadeAccessor() { return 'apiProviderService'; }
}
