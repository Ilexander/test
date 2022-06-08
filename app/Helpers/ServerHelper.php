<?php

namespace App\Helpers;

use App\Models\User;

class ServerHelper
{
    public static function getIp(): string
    {
        foreach ( User::IP_KEY_MAP as $key){
            if (array_key_exists($key, request()->server()) === true){
                foreach (explode(',', request()->server()[$key]) as $ip){
                    $ip = trim($ip);
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }

        return request()->server('REMOTE_ADDR');
    }
}