<?php

namespace App\Http\Middleware;

use App\Models\Language;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class SiteLanguage
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
        $languageList = array_map('strtolower', Language::query()->pluck('alt')->toArray());

        if (in_array($request->route()->parameter('language'), $languageList)) {

            config(['language.current' => $request->route()->parameter('language')]);

            App::setLocale($request->route()->parameter('language'));

            $response = $next($request);

//            if ( in_array($response->getStatusCode(), [500, 419]) ) {
//
//                if (explode('.', $request->route()->getName())[0] === 'auth') {
//                    return redirect()->route(
//                        explode('.', $request->route()->getName())[0].'.login',
//                        ['language' => Config::get('app.locale')]
//                    );
//                }
//
//                return redirect()->route(
//                    explode('.', $request->route()->getName())[0].'.dashboard',
//                    ['language' => Config::get('app.locale')]
//                );
//            }

            return $response;
        }

        App::setLocale('en');
        return redirect()->route('user.dashboard',   ['language' => 'en']);

    }
}
