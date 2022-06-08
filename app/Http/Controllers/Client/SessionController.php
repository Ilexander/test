<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Session\SessionAllRequest;
use App\Services\Session\SessionFacade;

class SessionController extends Controller
{
    public function all(SessionAllRequest $request): \Illuminate\View\View
    {
        $pageConfigs = ['pageHeader' => false];

        return view('home.session.session', [
            'pageConfigs' => $pageConfigs,
            'sessions' => SessionFacade::all($request),
        ]);
    }
}
