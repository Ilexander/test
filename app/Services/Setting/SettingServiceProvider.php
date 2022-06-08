<?php

namespace App\Services\Setting;

use App\Models\Settings;
use App\Repositories\Setting\SettingRepository;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('settingService', function($app) {
            return new SettingService(
                $app->make('App\Interfaces\Repositories\SettingInterface')
            );
        });

        $this->app->bind('App\Interfaces\Repositories\SettingInterface', function($app) {
            return new SettingRepository(new Settings());
        });
    }
}
