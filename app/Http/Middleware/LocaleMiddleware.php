<?php

namespace App\Http\Middleware;

use App\Helpers\EnvHelper;
use App\Models\Language;
use Closure;
use Illuminate\Http\Request;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (EnvHelper::databaseStatus()) {
            $language = Language::query()
//            ->where(
//                'supported_countries',
//                'like',
//                '%'.strtoupper(request()->server('HTTP_GEOIP_COUNTRY_CODE')).'%'
//            )
                ->where('alt', request()->route()->language)
                ->where('status', true)
                ->first();
            config(['system.orient' => (!is_null($language) ? strtolower($language->view) : 'ltr')]);

            $language = !is_null($language) ? strtolower($language->alt) : 'en';

            if(session()->has('locale')){
                app()->setLocale($language);
            }
        }

        return $next($request);
    }
}
