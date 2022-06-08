<?php

namespace App\Repositories\Setting;

use App\DTO\Setting\SettingItemDTO;
use App\Http\Requests\Setting\SettingAllInterface;
use App\Http\Requests\Setting\SettingCreateInterface;
use App\Http\Requests\Setting\SettingInfoInterface;
use App\Http\Requests\Setting\SettingUpdateInterface;
use App\Interfaces\Repositories\SettingInterface;
use App\Models\Settings;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class SettingRepository implements SettingInterface
{
    private Settings $setting;

    public function __construct(Settings $setting)
    {
        $this->setting = $setting;
    }

    public function list(SettingAllInterface $all): Collection
    {
        return $this
            ->setting
            ->newQuery()
            ->where('page_name', $all->getPageName())
            ->when($all->getFieldValue(), function ($query, $field_value) {
                return $query->where('field_value', $field_value);
            })
            ->when($all->getFieldName(), function ($query, $field_name) {
                return $query->where('field_name', $field_name);
            })
            ->get();
    }

    public function create(SettingItemDTO $create): Model
    {
        $this
            ->setting
            ->newQuery()
            ->where('page_name', $create->getPageName())
            ->where('field_name', $create->getFieldName())
            ->delete();

        /** @var Settings $setting */
        $setting = new $this->setting();
        $setting->fill([
            'page_name'     => $create->getPageName(),
            'field_name'    => $create->getFieldName(),
            'field_value'   => $create->getFieldValue(),
        ]);
        $setting->save();

        return $setting;
    }

    public function info(SettingInfoInterface $info): Model
    {
        return $this->setting->newQuery()->where('id', $info->getId())->first();
    }

    public function update(SettingUpdateInterface $update): bool
    {
        return $this
            ->setting
            ->newQuery()
            ->where('id', $update->getId())
            ->update([
                'page_name'     => $update->getPageName(),
                'field_name'    => $update->getFieldName(),
                'field_value'   => $update->getFieldValue(),
            ]);
    }
}
