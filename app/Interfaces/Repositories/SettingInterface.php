<?php

namespace App\Interfaces\Repositories;

use App\DTO\Setting\SettingItemDTO;
use App\Http\Requests\Setting\SettingAllInterface;
use App\Http\Requests\Setting\SettingCreateInterface;
use App\Http\Requests\Setting\SettingInfoInterface;
use App\Http\Requests\Setting\SettingUpdateInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface SettingInterface
{
    /**
     * @param SettingAllInterface $all
     * @return Collection
     */
    public function list(SettingAllInterface $all): Collection;

    /**
     * @param SettingItemDTO $create
     * @return Model
     */
    public function create(SettingItemDTO $create): Model;

    /**
     * @param SettingInfoInterface $info
     * @return Model
     */
    public function info(SettingInfoInterface $info): Model;

    /**
     * @param SettingUpdateInterface $update
     * @return bool
     */
    public function update(SettingUpdateInterface $update): bool;
}
