<?php

namespace App\Helpers;

use App\Http\Requests\Setting\SettingAllRequest;
use App\Models\Settings;
use App\Services\Setting\SettingFacade;
use DateTime;
use DateTimeZone;
use JetBrains\PhpStorm\ArrayShape;

class SupportHelper
{
    /**
     * @throws \Exception
     */
    #[ArrayShape(['support_online' => "bool", 'time_left' => "float|int|string"])]
    public static function getSupportStatus(): array
    {
        $info = new SettingAllRequest();
        $info->merge([
            'page_name' => Settings::SUPPORT_SETTINGS
        ]);
        $settings = SettingFacade::list($info);

        $supportStart = '';
        $supportEnd = '';


        foreach ($settings as $setting) {
            if ($setting->field_name == 'support_start_time') {
                $supportStart = (int)str_replace(':', '', $setting->field_value);
            }

            if ($setting->field_name == 'support_end_time') {
                $supportEnd = (int)str_replace(':', '', $setting->field_value);
            }
        }

        $timestamp = time();
        $dt = new DateTime("now", new DateTimeZone('Europe/Moscow'));
        $dt->setTimestamp($timestamp);

        $adminOnline = 0; //off


        $supportOnline = false;
        $timeLeft = 0;

        if (($supportStart <= $dt->format('Hi') && $dt->format('Hi') <= $supportEnd ) || $adminOnline == 1) {
            $supportOnline = true;
        }
        if (!$supportOnline) {
            if ($dt->format('Hi') < $supportStart) {

                $date = DateTime::createFromFormat("Y-m-d H:i", $dt->format('Y-m-d').' 16:00'); // задаем дату в любом формате
                $interval = $date->diff($dt);

                $timeLeft = $interval->h * 100 + $interval->i;
            } else {

                $date = DateTime::createFromFormat("Y-m-d H:i", $dt->format('Y-m-d').' 23:59');
                $interval = $dt->diff($date);
                $timeLeft = $interval->h * 100 + $interval->i + $supportStart;

            }
        }

        return [
            'support_online' => $supportOnline,
            'time_left' => $timeLeft,
        ];
    }
}
