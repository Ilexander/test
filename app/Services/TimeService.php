<?php

namespace App\Services;

class TimeService
{
    public function getTimezoneList(): array
    {
        $timestamp = time();
        $zones = [];
        foreach (timezone_identifiers_list() as $zone) {
            date_default_timezone_set($zone);

            $zones[$zone] = [
                'offset' => date('P', $timestamp),
                'diff_from_gtm' => 'UTC/GMT '.date('P', $timestamp)
            ];
        }

        return $zones;
    }

    public function checkTimezone(string $timezone): bool
    {
        return in_array($timezone, timezone_identifiers_list());
    }
}