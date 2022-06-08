<?php

namespace App\Providers;

use App\Helpers\EnvHelper;
use App\Models\Order;
use App\Models\Settings;
use App\Models\Transaction;
use App\Observers\OrderObserver;
use App\Observers\TransactionObserver;
use App\View\Components\Header;
use App\View\Components\Language;
//use App\View\Components\SidebarSetting;
use App\View\Components\NavBar;
use App\View\Components\Orientation;
use App\View\Components\Register;
use App\View\Components\UnreadMessage;
use App\View\Components\UnreadTickets;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Transaction::observe(TransactionObserver::class);
        Order::observe(OrderObserver::class);
        Blade::component('language-selector', Language::class);
        Blade::component('unread-ticket-count', UnreadMessage::class);
        Blade::component('nav-bar', NavBar::class);
        Blade::component('header', Header::class);
        Blade::component('unread-tickets', UnreadTickets::class);
        Blade::component('user-register', Register::class);
        Blade::component('page-orientation', Orientation::class);

        // if(EnvHelper::databaseStatus()) {
        //     $settings = Settings::query()
        //         ->where('page_name', Settings::RECAPTCHA_SETTINGS)
        //         ->get()
        //         ->keyBy('field_name')
        //         ->toArray();

        //     config(['recaptcha.api_site_key' => $settings['recaptcha_site_key']['field_value']]);
        //     config(['recaptcha.api_secret_key' => $settings['recaptcha_secret_key']['field_value']]);
        // }
    }
}
