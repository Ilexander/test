<?php

namespace App\Services\Setting;

use App\DTO\Setting\SettingItemDTO;
use App\Http\Requests\Setting\SettingAllInterface;
use App\Http\Requests\Setting\SettingCreateInterface;
use App\Http\Requests\Setting\SettingInfoInterface;
use App\Http\Requests\Setting\SettingUpdateInterface;
use App\Interfaces\Repositories\SettingInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class SettingService
{
    private SettingInterface $setting;

    public function __construct(SettingInterface $setting)
    {
        $this->setting = $setting;
    }

    /**
     * @param SettingAllInterface $all
     * @return Collection
     */
    public function list(SettingAllInterface $all): Collection
    {
        return $this->setting->list($all);
    }

    /**
     * @param SettingItemDTO $create
     * @return Model
     */
    public function create(SettingItemDTO $create): Model
    {
        return $this->setting->create($create);
    }

    /**
     * @param SettingInfoInterface $info
     * @return Model
     */
    public function info(SettingInfoInterface $info): Model
    {
        return $this->setting->info($info);
    }

    /**
     * @param SettingUpdateInterface $update
     * @return bool
     */
    public function update(SettingUpdateInterface $update): bool
    {
        return $this->setting->update($update);
    }
}
