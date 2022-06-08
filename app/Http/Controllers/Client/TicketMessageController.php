<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\TicketAllRequest;
use App\Http\Requests\Ticket\TicketUpdateRequest;
use App\Http\Requests\TicketMessage\TicketChatRequest;
use App\Http\Requests\TicketMessage\TicketMessageAllRequest;
use App\Http\Requests\TicketMessage\TicketMessageCreateRequest;
use App\Http\Requests\TicketMessage\TicketMessageDeleteRequest;
use App\Http\Requests\TicketMessage\TicketMessageInfoRequest;
use App\Http\Requests\TicketMessage\TicketMessageTicketRequest;
use App\Http\Requests\TicketMessage\TicketMessageUpdateRequest;
use App\Http\Requests\TicketMessage\TicketMessageUserRequest;
use App\Http\Resources\MessageResource;
use App\Models\Ticket;
use App\Services\Ticket\TicketFacade;
use App\Services\Ticket\TicketMessage\TicketMessageFacade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketMessageController extends Controller
{

    public function chat(TicketChatRequest $request)
    {
        $allTickets = new TicketAllRequest();
        $allTickets->merge([
            'filter_status' => (Auth::user()->isAdmin() ? Ticket::WAIT_FOR_ADMIN_ANSWER : Ticket::WAIT_FOR_USER_ANSWER)
        ]);

        return view('user.ticket_chat', [
            'messages' => MessageResource::collection(TicketMessageFacade::ticket($request)),
            'ticket_id' => $request->getTicketId(),
            'user' => Auth::user(),
            "tickets" => TicketFacade::getAllTickets($allTickets)
        ]);
    }
    /**
     * @param TicketMessageCreateRequest $request
     * @return JsonResponse
     */
    public function add(TicketMessageCreateRequest $request): JsonResponse
    {
        return response()->json(['status' => TicketMessageFacade::add($request)]);
    }

    /**
     * @param TicketMessageInfoRequest $request
     * @return JsonResponse
     */
    public function info(TicketMessageInfoRequest $request): JsonResponse
    {
        return response()->json(['data' => new MessageResource(TicketMessageFacade::read($request))]);
    }

    /**
     * @param TicketMessageUpdateRequest $request
     * @return JsonResponse
     */
    public function update(TicketMessageUpdateRequest $request): JsonResponse
    {
        return response()->json(['status' => TicketMessageFacade::update($request)]);
    }

    /**
     * @param TicketMessageDeleteRequest $request
     * @return JsonResponse
     */
    public function delete(TicketMessageDeleteRequest $request): JsonResponse
    {
        return response()->json(['status' => TicketMessageFacade::delete($request)]);
    }

    /**
     * @param TicketMessageAllRequest $request
     * @return JsonResponse
     */
    public function list(TicketMessageAllRequest $request): JsonResponse
    {
        return response()->json(['data' => MessageResource::collection(TicketMessageFacade::list($request))]);
    }

    /**
     * @param TicketMessageUserRequest $request
     * @return JsonResponse
     */
    public function user(TicketMessageUserRequest $request): JsonResponse
    {
        return response()->json(['data' => MessageResource::collection(TicketMessageFacade::user($request))]);
    }

    /**
     * @param TicketMessageTicketRequest $request
     * @return JsonResponse
     */
    public function ticket(TicketMessageTicketRequest $request): JsonResponse
    {
        return response()->json(['data' => MessageResource::collection(TicketMessageFacade::ticket($request))]);
    }
}
