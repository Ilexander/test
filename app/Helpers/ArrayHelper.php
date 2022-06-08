<?php

namespace App\Helpers;

class ArrayHelper
{
    public static function filterEmpty(array $array): array
    {
        return array_filter($array, fn($value) => (!is_null($value) && $value !== ""));
    }
}
