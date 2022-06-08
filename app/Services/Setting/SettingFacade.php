<?php

namespace App\Services\Setting;

use App\DTO\Setting\SettingItemDTO;
use App\Http\Requests\Setting\SettingAllInterface;
use App\Http\Requests\Setting\SettingInfoInterface;
use App\Http\Requests\Setting\SettingUpdateInterface;
use Illuminate\Support\Facades\Facade;

/**
 * @method static list(SettingAllInterface $all)
 * @method static create(SettingItemDTO $create)
 * @method static info(SettingInfoInterface $info)
 * @method static update(SettingUpdateInterface $update)
 */
class SettingFacade extends Facade
{
    protected static function getFacadeAccessor() { return 'settingService'; }
}
