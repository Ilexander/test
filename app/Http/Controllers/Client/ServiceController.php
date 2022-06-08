<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiProvider\ApiProviderAllRequest;
use App\Http\Requests\Category\CategoryAllRequest;
use App\Http\Requests\Service\ApiServiceRequest;
use App\Http\Requests\Service\ServiceAllRequest;
use App\Http\Requests\Service\ServiceCreateRequest;
use App\Http\Requests\Service\ServiceDeleteRequest;
use App\Http\Requests\Service\ServiceInfoRequest;
use App\Http\Requests\Service\ServiceUpdateRequest;
use App\Http\Requests\Ticket\TicketAllRequest;
use App\Http\Resources\Service\ServiceInfoResource;
use App\Http\Resources\Service\ServiceListResource;
use App\Models\Service;
use App\Models\Ticket;
use App\Services\ApiProvider\ApiProviderFacade;
use App\Services\Category\CategoryFacade;
use App\Services\Order\OrderApiService;
use App\Services\Service\ServiceFacade;
use App\Services\Ticket\TicketFacade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\View\View;

class ServiceController extends Controller
{
    private OrderApiService $orderApiService;

    public function __construct(OrderApiService $orderApiService)
    {
        $this->orderApiService = $orderApiService;
    }

    /**
     * @param ServiceAllRequest $request
     * @return JsonResponse
     */
    public function list(ServiceAllRequest $request): JsonResponse
    {
        return response()->json(['data' => ServiceListResource::collection(ServiceFacade::all($request))]);
    }
    /**
     * @param ServiceAllRequest $request
     * @return View
     */
    public function all(ServiceAllRequest $request): View
    {
        $allTickets = new TicketAllRequest();
        $allTickets->merge([
            'filter_status' => (Auth::user()->isAdmin() ? Ticket::WAIT_FOR_ADMIN_ANSWER : Ticket::WAIT_FOR_USER_ANSWER)
        ]);

        $pageConfigs = ['pageHeader' => false];

        return view('user.service', [
            'pageConfigs' => $pageConfigs,
            'services' => ServiceFacade::formResponseCollection(ServiceFacade::all($request)),
            'categories' => CategoryFacade::list(new CategoryAllRequest()),
            'providers' => ApiProviderFacade::formResponseCollection(ApiProviderFacade::list(new ApiProviderAllRequest())),
            "tickets" => TicketFacade::getAllTickets($allTickets)
        ]);
    }

    /**
     * @param ServiceCreateRequest $request
     * @return RedirectResponse
     */
    public function create(ServiceCreateRequest $request): RedirectResponse
    {
        ServiceFacade::create($request);

        return redirect()->route((Auth::user()->isAdmin() ? 'admin.' : 'user.'). 'service.all',
            [
                'language' => Config::get('app.locale')
            ]);
    }

    /**
     * @param ServiceInfoRequest $request
     * @return JsonResponse
     */
    public function info(ServiceInfoRequest $request): JsonResponse
    {
        return response()->json(['data' => new ServiceInfoResource(ServiceFacade::info($request))]);
    }

    /**
     * @param ServiceUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(ServiceUpdateRequest $request): RedirectResponse
    {
        ServiceFacade::update($request);

        return redirect()->route((Auth::user()->isAdmin() ? 'admin.' : 'user.'). 'service.all',
            [
                'language' => Config::get('app.locale')
            ]);
    }

    public function changeStatus(Request $request)
    {
        Service::query()
            ->whereIn('id', $request->ids)
            ->update([
                'status' => json_decode($request->status)
            ]);

        return response()->json(['status' => true]);
    }

    /**
     * @param ServiceDeleteRequest $request
     * @return JsonResponse
     */
    public function delete(ServiceDeleteRequest $request): JsonResponse
    {
        return response()->json(['status' => ServiceFacade::delete($request)]);
    }
}
