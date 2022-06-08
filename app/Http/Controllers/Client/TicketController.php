<?php

namespace App\Http\Controllers\Client;

use App\Helpers\SupportHelper;
use App\Http\Requests\Payment\PaymentAllRequest;
use App\Http\Requests\Ticket\TicketAllRequest;
use App\Http\Requests\Ticket\TicketCreateRequest;
use App\Http\Requests\Ticket\TicketDeleteRequest;
use App\Http\Requests\Ticket\TicketInfoRequest;
use App\Http\Requests\Ticket\TicketStatusUpdateRequest;
use App\Http\Requests\Ticket\TicketUpdateRequest;
use App\Http\Requests\Ticket\TicketUserRequest;
use App\Models\Ticket;
use App\Services\Payment\PaymentFacade;
use App\Services\Ticket\TicketFacade;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TicketController extends Controller
{
    /**
     * @param TicketCreateRequest $request
     * @return JsonResponse
     */
    public function create(TicketCreateRequest $request): JsonResponse
    {
        return response()->json(['status' => Auth::user() ? TicketFacade::addTicket($request) : true]);
    }

    /**
     * @param TicketUpdateRequest $request
     * @return JsonResponse
     */
    public function update(TicketUpdateRequest $request): JsonResponse
    {
        return response()->json(['status' => TicketFacade::updateTicket($request)]);
    }

    /**
     * @param TicketInfoRequest $request
     * @return JsonResponse
     */
    public function read(TicketInfoRequest $request): JsonResponse
    {
        return response()->json(['data' => TicketFacade::getTicket($request)]);
    }

    /**
     * @param TicketDeleteRequest $request
     * @return JsonResponse
     */
    public function delete(TicketDeleteRequest $request): JsonResponse
    {
        return response()->json(['status' => TicketFacade::deleteTicket($request)]);
    }

    /**
     * @param TicketAllRequest $request
     * @return View
     * @throws \Exception
     */
    public function list(TicketAllRequest $request): View
    {
        $pageConfigs = [
            'pageHeader' => false,
            'contentLayout' => "content-left-sidebar",
            'pageClass' => 'email-application',
        ];

        $allTickets = new TicketAllRequest();
        $allTickets->merge([
            'filter_status' => (Auth::user()->isAdmin() ? Ticket::WAIT_FOR_ADMIN_ANSWER : Ticket::WAIT_FOR_USER_ANSWER)
        ]);

        return view('user.ticket', [
            "user"  => Auth::user(),
            'pageConfigs' => $pageConfigs,
            'tickets' => TicketFacade::getAllTickets($allTickets),
            'ticketsShow' => TicketFacade::getAllTickets($request),
            "ticketsList" => TicketFacade::getAllTickets(new TicketAllRequest()),
            'subjects' => config('ticket.subjects'),
            'requests'  => config('ticket.request'),
            'payments' => PaymentFacade::formResponseCollection(PaymentFacade::list(new PaymentAllRequest())),
            'support' => SupportHelper::getSupportStatus()
        ]);
//        return response()->json(['data' => TicketFacade::getAllTickets($request)]);
    }

    /**
     * @param TicketUserRequest $request
     * @return JsonResponse
     */
    public function toUser(TicketUserRequest $request): JsonResponse
    {
        return response()->json(['status' => TicketFacade::userTicket($request)]);
    }

    public function importantChange(TicketInfoRequest $request)
    {
        TicketFacade::importantChangeTicket($request);
    }

    public function changeStatus(TicketStatusUpdateRequest $request): JsonResponse
    {
        return response()->json([
            'status' => TicketFacade::updateStatus($request->getTicketId(), $request->getStatusId())
        ]);
    }

    public function getTicketStatusList(): JsonResponse
    {
        return response()->json([
            'result' => Ticket::TICKET_STATUS_LIST
        ]);
    }
}
