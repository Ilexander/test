<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\PaymentAllRequest;
use App\Http\Requests\PaymentBonus\PaymentBonusAllRequest;
use App\Http\Requests\PaymentBonus\PaymentBonusCreateRequest;
use App\Http\Requests\PaymentBonus\PaymentBonusDeleteRequest;
use App\Http\Requests\PaymentBonus\PaymentBonusInfoRequest;
use App\Http\Requests\PaymentBonus\PaymentBonusUpdateRequest;
use App\Http\Requests\Ticket\TicketAllRequest;
use App\Models\PaymentBonus;
use App\Models\Ticket;
use App\Services\Payment\PaymentBonus\PaymentBonusFacade;
use App\Services\Payment\PaymentFacade;
use App\Services\Ticket\TicketFacade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\View\View;

class PaymentBonusController extends Controller
{
    /**
     * @param PaymentBonusAllRequest $request
     * @return View
     */
    public function all(PaymentBonusAllRequest $request): View
    {
        $pageConfigs = ['pageHeader' => false];

        $allTickets = new TicketAllRequest();
        $allTickets->merge([
            'filter_status' => (Auth::user()->isAdmin() ? Ticket::WAIT_FOR_ADMIN_ANSWER : Ticket::WAIT_FOR_USER_ANSWER)
        ]);

        return view('user.payment-bonuses', [
            'pageConfigs' => $pageConfigs,
            'paymentBonuses' => PaymentBonusFacade::all($request),
            'payments' => PaymentFacade::list(new PaymentAllRequest()),
            "tickets" => TicketFacade::getAllTickets($allTickets),
        ]);
    }

    /**
     * @param PaymentBonusInfoRequest $request
     * @return JsonResponse
     */
    public function info(PaymentBonusInfoRequest $request): JsonResponse
    {
        return response()->json(['data' => PaymentBonusFacade::info($request)]);
    }

    /**
     * @param PaymentBonusCreateRequest $request
     * @return RedirectResponse
     */
    public function create(PaymentBonusCreateRequest $request): RedirectResponse
    {
        PaymentBonusFacade::create($request);

        return redirect()->route('admin.payment.payment-bonus.list', ['language' => Config::get('language.current')]);
    }

    /**
     * @param PaymentBonusUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(PaymentBonusUpdateRequest $request): RedirectResponse
    {
        PaymentBonusFacade::update($request);

        return redirect()->route('admin.payment.payment-bonus.list', ['language' => Config::get('language.current')]);
    }

    /**
     * @param PaymentBonusDeleteRequest $request
     * @return JsonResponse
     */
    public function delete(PaymentBonusDeleteRequest $request): JsonResponse
    {
        return response()->json(['status' => PaymentBonusFacade::delete($request)]);
    }

    public function changeStatus(Request $request): JsonResponse
    {
        PaymentBonus::query()
            ->whereIn('id', $request->ids)
            ->update([
                'status' => json_decode($request->status)
            ]);

        return response()->json(['status' => true]);
    }
}
