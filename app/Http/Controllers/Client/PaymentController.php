<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\PaymentAllRequest;
use App\Http\Requests\Payment\PaymentCreateRequest;
use App\Http\Requests\Payment\PaymentDeleteRequest;
use App\Http\Requests\Payment\PaymentInfoRequest;
use App\Http\Requests\Payment\PaymentUpdateRequest;
use App\Http\Requests\Ticket\TicketAllRequest;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use App\Models\Ticket;
use App\Services\Payment\PaymentFacade;
use App\Services\Ticket\TicketFacade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

/**
 * Class PaymentController
 * @package App\Http\Controllers\Client
 */
class PaymentController extends Controller
{
    public function all(PaymentAllRequest $request)
    {
        return response()->json(['data' => PaymentFacade::formResponseCollection(PaymentFacade::list($request))]);
    }
    /**
     * @param PaymentAllRequest $request
     * @return View
     */
    public function list(PaymentAllRequest $request): View
    {
        $allTickets = new TicketAllRequest();
        $allTickets->merge([
            'filter_status' => (Auth::user()->isAdmin() ? Ticket::WAIT_FOR_ADMIN_ANSWER : Ticket::WAIT_FOR_USER_ANSWER)
        ]);

        $pageConfigs = ['pageHeader' => false];

        return view('user.payments', [
            'pageConfigs' => $pageConfigs,
            'payments' => PaymentFacade::list($request),
            "tickets" => TicketFacade::getAllTickets($allTickets),
        ]);
    }

    /**
     * @param PaymentCreateRequest $request
     * @return RedirectResponse
     */
    public function create(PaymentCreateRequest $request): RedirectResponse
    {
        PaymentFacade::add($request);

        return redirect()->route('admin.payment.list', ['language' => Config::get('language.current')]);
    }

    /**
     * @param PaymentUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(PaymentUpdateRequest $request): RedirectResponse
    {
        PaymentFacade::update($request);

        return redirect()->route('admin.payment.list', ['language' => Config::get('language.current')]);
    }

    /**
     * @param PaymentDeleteRequest $request
     * @return JsonResponse
     */
    public function delete(PaymentDeleteRequest $request): JsonResponse
    {
        return response()->json(['status' => PaymentFacade::delete($request)]);
    }

    /**
     * @param PaymentInfoRequest $request
     * @return JsonResponse
     */
    public function info(PaymentInfoRequest $request): JsonResponse
    {
        return response()->json(['data' => PaymentFacade::info($request)]);
    }

    public function changeStatus(Request $request): JsonResponse
    {
        Payment::query()
            ->whereIn('id', $request->ids)
            ->update([
                'status' => json_decode($request->status)
            ]);

        return response()->json(['status' => true]);
    }
}
