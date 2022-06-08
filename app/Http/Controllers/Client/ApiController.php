<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ApiDocParams\ApiDocParamsCreateRequest;
use App\Http\Requests\Api\ApiDocs\ApiDocsAllRequest;
use App\Http\Requests\Api\ApiDocs\ApiDocsCreateRequest;
use App\Http\Requests\Api\ApiDocs\ApiDocsDeleteRequest;
use App\Http\Requests\Api\ApiDocs\ApiDocsInfoRequest;
use App\Http\Requests\Api\ApiDocs\ApiDocsUpdateRequest;
use App\Http\Requests\Api\UserApiRequest;
use App\Http\Requests\Order\OrderCreateRequest;
use App\Http\Requests\Ticket\TicketAllRequest;
use App\Http\Requests\User\UserAllRequest;
use App\Models\Ticket;
use App\Services\Api\ApiDocFacade;
use App\Services\Api\ApiDocParamsFacade;
use App\Services\Api\UserApiService;
use App\Services\Currency\CurrencyFacade;
use App\Services\Order\OrderFacade;
use App\Services\Ticket\TicketFacade;
use App\Services\User\UserFacade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\View\View;

class ApiController extends Controller
{
    public function __construct(private UserApiService $userApiService)
    {}

    /**
     * @param UserApiRequest $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'key' => 'required|exists:users,api_key',
            'action' => 'required|in:add,status,services,balance',
            'order'  => 'nullable|numeric|min:1',
            'orders' => 'nullable|array',
            'orders.*' => 'required|numeric|min:1',
            'service'  => 'required_if:action,add|exists:services,id',
            'link'     => 'required_if:action,add|url',
            'quantity' => 'required_if:action,add|numeric|min:1',
            'runs'     => 'nullable|numeric|min:1',
            'interval' => 'nullable|numeric|min:1',
        ]);

        switch ($validatedData['action']) {
            case "add":
                return response()->json([ 'status' => $this->userApiService->addOrder(
                    $validatedData['service'],
                    $validatedData['link'],
                    $validatedData['quantity'],
                    $validatedData['key'],
                    $validatedData['runs'],
                    $validatedData['interval'],
                )]);
            case "status":
                if ($validatedData['orders']) {
                    return response()->json($this->userApiService->status($validatedData['orders'], $validatedData['key']));
                }
                if($validatedData['order']) {
                    $result = $this->userApiService->status([$validatedData['order']], $validatedData['key']);
                    return response()->json($result[$validatedData['order']]);
                }
            break;
            case "services":
                return response()->json($this->userApiService->services());
            case "balance":
                return response()->json($this->userApiService->balance($validatedData['key']));
            default:
                return response()->json([
                    "status"    => "error",
                    "message"   => "wrong params"
                ]);
        }

        return response()->json([
            "status"    => "error",
            "message"   => "wrong params"
        ]);
    }

    /**
     * @param ApiDocsAllRequest $request
     * @return View
     */
    public function list(ApiDocsAllRequest $request): View
    {
        $allTickets = new TicketAllRequest();
        $allTickets->merge([
            'filter_status' => (Auth::user()->isAdmin() ? Ticket::WAIT_FOR_ADMIN_ANSWER : Ticket::WAIT_FOR_USER_ANSWER)
        ]);

        return view('user.api-doc', [
            'apiDocs' => ApiDocFacade::list($request),
            "tickets" => TicketFacade::getAllTickets($allTickets)
        ]);
    }

    /**
     * @param ApiDocsCreateRequest $request
     * @return RedirectResponse
     */
    public function create(ApiDocsCreateRequest $request): RedirectResponse
    {
        ApiDocFacade::create($request);

        return redirect()->route('api-doc.list', ['language' => Config::get('app.locale')]);
    }

    /**
     * @param ApiDocsUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(ApiDocsUpdateRequest $request): RedirectResponse
    {
        ApiDocFacade::update($request);

        return redirect()->route('api-doc.list', ['language' => Config::get('app.locale')]);
    }

    /**
     * @param ApiDocsInfoRequest $request
     * @return JsonResponse
     */
    public function info(ApiDocsInfoRequest $request): JsonResponse
    {
        return response()->json(['data' => ApiDocFacade::info($request)]);
    }

    /**
     * @param ApiDocsDeleteRequest $request
     * @return JsonResponse
     */
    public function delete(ApiDocsDeleteRequest $request): JsonResponse
    {
        return response()->json(['status' => ApiDocFacade::delete($request)]);
    }

    public function createParam(ApiDocParamsCreateRequest $request)
    {

    }
}
