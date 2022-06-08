<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiProvider\ApiProviderAllRequest;
use App\Http\Requests\ApiProvider\ApiProviderCreateRequest;
use App\Http\Requests\ApiProvider\ApiProviderDeleteRequest;
use App\Http\Requests\ApiProvider\ApiProviderInfoRequest;
use App\Http\Requests\ApiProvider\ApiProviderUpdateRequest;
use App\Http\Requests\Ticket\TicketAllRequest;
use App\Models\Ticket;
use App\Services\ApiProvider\ApiProviderFacade;
use App\Services\Currency\CurrencyFacade;
use App\Services\Service\ServiceFacade;
use App\Services\Ticket\TicketFacade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\View\View;

class ApiProviderController extends Controller
{
    /**
     * @param ApiProviderAllRequest $request
     * @return View
     */
    public function list(ApiProviderAllRequest $request): View
    {
        $allTickets = new TicketAllRequest();
        $allTickets->merge([
            'filter_status' => (Auth::user()->isAdmin() ? Ticket::WAIT_FOR_ADMIN_ANSWER : Ticket::WAIT_FOR_USER_ANSWER)
        ]);

        $pageConfigs = ['pageHeader' => false];

        return view('home.api-provider.api-provider', [
            'pageConfigs' => $pageConfigs,
            'apiProviders' => ApiProviderFacade::list($request),
            'currencies' => CurrencyFacade::list(),
            "tickets" => TicketFacade::getAllTickets($allTickets)
        ]);
    }

    /**
     * @param ApiProviderInfoRequest $request
     * @return JsonResponse
     */
    public function info(ApiProviderInfoRequest $request): JsonResponse
    {
        return response()->json(['data' => ApiProviderFacade::info($request)]);
    }

    /**
     * @param ApiProviderCreateRequest $request
     * @return RedirectResponse
     */
    public function create(ApiProviderCreateRequest $request): RedirectResponse
    {
        ApiProviderFacade::create($request);

        return redirect()->route('api-provider.list', ['language' => Config::get('app.locale')]);
    }

    /**
     * @param ApiProviderUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(ApiProviderUpdateRequest $request): RedirectResponse
    {
        ApiProviderFacade::update($request);

        return redirect()->route('api-provider.list', ['language' => Config::get('app.locale')]);
    }

    /**
     * @param ApiProviderDeleteRequest $request
     * @return JsonResponse
     */
    public function delete(ApiProviderDeleteRequest $request): JsonResponse
    {
        return response()->json(['status' => ApiProviderFacade::delete($request)]);
    }

    /**
     * @param ApiProviderInfoRequest $request
     * @return JsonResponse
     */
    public function getApiProviderServices(ApiProviderInfoRequest $request): JsonResponse
    {
        return response()->json(['data' => ApiProviderFacade::services($request)]);
    }
}
