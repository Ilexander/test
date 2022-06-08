<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Currency\CurrencyAllRequest;
use App\Http\Requests\Currency\CurrencyCreateRequest;
use App\Http\Requests\Currency\CurrencyDeleteRequest;
use App\Http\Requests\Currency\CurrencyInfoRequest;
use App\Http\Requests\Currency\CurrencyUpdateRequest;
use App\Services\Currency\CurrencyFacade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\View\View;

/**
 * Class CurrencyController
 * @package App\Http\Controllers\Client
 */
class CurrencyController extends Controller
{
    /**
     * @param CurrencyAllRequest $request
     * @return View
     */
    public function all(CurrencyAllRequest $request): View
    {
        $pageConfigs = ['pageHeader' => false];

        return view('home.currency.currency', [
            'pageConfigs' => $pageConfigs,
            'currencies' => CurrencyFacade::all($request)
        ]);
    }

    /**
     * @param CurrencyCreateRequest $request
     * @return JsonResponse
     */
    public function create(CurrencyCreateRequest $request): RedirectResponse
    {
        CurrencyFacade::add($request);

        return redirect()->route('currency.all', ['language' => Config::get('language.current')]);
    }

    /**
     * @param CurrencyUpdateRequest $request
     * @return JsonResponse
     */
    public function update(CurrencyUpdateRequest $request): RedirectResponse
    {
        CurrencyFacade::update($request);

        return redirect()->route('currency.all', ['language' => Config::get('language.current')]);
    }

    /**
     * @param CurrencyDeleteRequest $request
     * @return JsonResponse
     */
    public function delete(CurrencyDeleteRequest $request): JsonResponse
    {
        return response()->json(['status' => CurrencyFacade::delete($request)]);
    }

    /**
     * @param CurrencyInfoRequest $request
     * @return JsonResponse
     */
    public function info(CurrencyInfoRequest $request): JsonResponse
    {
        return response()->json(['data' => CurrencyFacade::info($request)]);
    }

    /**
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
        return response()->json(['data' => CurrencyFacade::list()]);
    }
}
