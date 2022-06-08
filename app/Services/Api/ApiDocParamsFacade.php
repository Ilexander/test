<?php

namespace App\Services\Api;

use App\Http\Requests\Api\ApiDocParams\ApiDocParamsCreateInterface;
use App\Http\Requests\Api\ApiDocParams\ApiDocParamsDeleteInterface;
use App\Http\Requests\Api\ApiDocParams\ApiDocParamsListInterface;
use Illuminate\Support\Facades\Facade;

/**
 * @method static list(ApiDocParamsListInterface $list)
 * @method static create(ApiDocParamsCreateInterface $create)
 * @method static delete(ApiDocParamsDeleteInterface $delete)
 */
class ApiDocParamsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "apiDocParamsService";
    }
}