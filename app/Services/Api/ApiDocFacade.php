<?php

namespace App\Services\Api;

use App\Http\Requests\Api\ApiDocs\ApiDocsAllInterface;
use App\Http\Requests\Api\ApiDocs\ApiDocsCreateInterface;
use App\Http\Requests\Api\ApiDocs\ApiDocsDeleteInterface;
use App\Http\Requests\Api\ApiDocs\ApiDocsInfoInterface;
use App\Http\Requests\Api\ApiDocs\ApiDocsUpdateInterface;
use Illuminate\Support\Facades\Facade;

/**
 * @method static list(ApiDocsAllInterface $list)
 * @method static info(ApiDocsInfoInterface $info)
 * @method static create(ApiDocsCreateInterface $create)
 * @method static update(ApiDocsUpdateInterface $update)
 * @method static delete(ApiDocsDeleteInterface $delete)
 */
class ApiDocFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "apiDocService";
    }
}