<?php

namespace App\Services\Service;

use App\Http\Requests\Service\ServiceAllInterface;
use App\Http\Requests\Service\ServiceCreateInterface;
use App\Http\Requests\Service\ServiceDeleteInterface;
use App\Http\Requests\Service\ServiceInfoInterface;
use App\Http\Requests\Service\ServiceUpdateInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @method static all(ServiceAllInterface $all)
 * @method static info(ServiceInfoInterface $info)
 * @method static create(ServiceCreateInterface $create)
 * @method static update(ServiceUpdateInterface $update)
 * @method static delete(ServiceDeleteInterface $delete)
 * @method static getTopBestsellers(?int $user_id)
 * @method static formResponseCollection(Collection $payments)
 */
class ServiceFacade extends Facade
{
    protected static function getFacadeAccessor() { return 'serviceService'; }
}
