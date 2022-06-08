<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subscribe\SubscribeAllRequest;
use App\Http\Requests\Subscribe\SubscribeCreateRequest;
use App\Http\Requests\Subscribe\SubscribeDeleteRequest;
use App\Http\Requests\Subscribe\SubscribeInfoRequest;
use App\Http\Requests\Subscribe\SubscribeUpdateRequest;
use App\Http\Requests\Ticket\TicketAllRequest;
use App\Models\Ticket;
use App\Models\User;
use App\Services\Email\MailToSubscriberService;
use App\Services\Subscribe\SubscribeFacade;
use App\Services\Ticket\TicketFacade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\View\View;

class SubscribeController extends Controller
{
    /**
     * @param SubscribeAllRequest $request
     * @return View
     */
    public function all(SubscribeAllRequest $request): View
    {
        $allTickets = new TicketAllRequest();
        $allTickets->merge([
            'filter_status' => (Auth::user()->isAdmin() ? Ticket::WAIT_FOR_ADMIN_ANSWER : Ticket::WAIT_FOR_USER_ANSWER)
        ]);

        $pageConfigs = ['pageHeader' => false];

        return view('admin.subscriptions_new', [
            'pageConfigs' => $pageConfigs,
            'subscribers' => SubscribeFacade::all($request),
            "tickets" => TicketFacade::getAllTickets($allTickets)
        ]);
    }

    /**
     * @param SubscribeCreateRequest $request
     * @return RedirectResponse
     */
    public function create(SubscribeCreateRequest $request): RedirectResponse
    {
        SubscribeFacade::create($request);

        return redirect()->route('auth.login', ['language' => Config::get('app.locale')]);
    }

    /**
     * @param SubscribeUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(SubscribeUpdateRequest $request): RedirectResponse
    {
        SubscribeFacade::update($request);

        return redirect()->route('auth.login', ['language' => Config::get('app.locale')]);
    }

    /**
     * @param SubscribeInfoRequest $request
     * @return JsonResponse
     */
    public function info(SubscribeInfoRequest $request): JsonResponse
    {
        return response()->json(['data' => SubscribeFacade::info($request)]);
    }

    /**
     * @param SubscribeDeleteRequest $request
     * @return JsonResponse
     */
    public function delete(SubscribeDeleteRequest $request): JsonResponse
    {
        return response()->json(['status' => SubscribeFacade::delete($request)]);
    }

    public function sendMail(Request $request): RedirectResponse
    {
        $user = new User();
        $user->email = $request->email;

        $service = new MailToSubscriberService();
        $service->setUser($user);
        $service->formData('message subscription', $request->message);
        $service->sendMail();

        return redirect()->back();
    }
}
