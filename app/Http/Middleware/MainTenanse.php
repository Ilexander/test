<?php

namespace App\Http\Middleware;

use App\Models\Settings;
use Closure;
use Illuminate\Http\Request;

class MainTenanse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        /** @var Settings $mainTenance */
        $mainTenance = Settings::query()->where('field_name','main_tenance_mode')->first();
        if((bool)$mainTenance->field_value) {
            return redirect()->route('maintenance');
        }

        return $next($request);
    }
}
