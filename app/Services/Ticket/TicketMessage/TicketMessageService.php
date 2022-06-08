<?php

namespace App\Services\Ticket\TicketMessage;

use App\Http\Requests\Ticket\TicketInfoRequest;
use App\Http\Requests\Ticket\TicketUpdateInterface;
use App\Http\Requests\TicketMessage\TicketMessageAllInterface;
use App\Http\Requests\TicketMessage\TicketMessageCreateInterface;
use App\Http\Requests\TicketMessage\TicketMessageDeleteInterface;
use App\Http\Requests\TicketMessage\TicketMessageInfoInterface;
use App\Http\Requests\TicketMessage\TicketMessageTicketInterface;
use App\Http\Requests\TicketMessage\TicketMessageUpdateInterface;
use App\Http\Requests\TicketMessage\TicketMessageUserInterface;
use App\Interfaces\Repositories\TicketInterface;
use App\Interfaces\Repositories\TicketMessageInterface;
use App\Models\Ticket;
use App\Models\User;
use App\Services\Ticket\TicketFacade;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TicketMessageService
{
    protected TicketMessageInterface $messageRepo;
    protected TicketInterface $repo;

    public function __construct(TicketMessageInterface $messageRepo, TicketInterface $repo)
    {
        $this->messageRepo = $messageRepo;
        $this->repo = $repo;
    }

    /**
     * @param TicketMessageCreateInterface $create
     * @return bool
     */
    public function add(TicketMessageCreateInterface $create): bool
    {
        $result = $this->messageRepo->saveTickerMessage($create);

        if ($result) {
            $status = Ticket::WAIT_FOR_ADMIN_ANSWER;

            /** @var User $user */
            $user = Auth::user();

            if ($user->hasRole(User::ROLE_ADMIN)) {
                $status = Ticket::WAIT_FOR_USER_ANSWER;
            }
            $this->repo->updateTicketStatus($create->getTicketId(), $status);
        }
        return $result;
    }

    /**
     * @param TicketMessageInfoInterface $info
     * @return Model
     */
    public function read(TicketMessageInfoInterface $info): Model
    {
        return $this->messageRepo->getTicketMessage($info);
    }

    /**
     * @param TicketMessageUpdateInterface $update
     * @return bool
     */
    public function update(TicketMessageUpdateInterface $update): bool
    {
        return $this->messageRepo->updateTicketMessage($update);
    }

    /**
     * @param TicketMessageDeleteInterface $delete
     * @return bool
     */
    public function delete(TicketMessageDeleteInterface $delete): bool
    {
        return $this->messageRepo->deleteTicketMessage($delete);
    }

    /**
     * @param TicketMessageAllInterface $all
     * @return Collection
     */
    public function list(TicketMessageAllInterface $all): Collection
    {
        return $this->messageRepo->getTicketMessageList($all);
    }

    /**
     * @param TicketMessageUserInterface $user
     * @return Collection
     */
    public function user(TicketMessageUserInterface $user): Collection
    {
        return $this->messageRepo->userTicketMessage($user);
    }

    /**
     * @param TicketMessageTicketInterface $ticket
     * @return Collection
     */
    public function ticket(TicketMessageTicketInterface $ticket): Collection
    {
        $info = new TicketInfoRequest();
        $info->merge([
            "id" => $ticket->getTicketId()
        ]);

//        $searchTicket = TicketFacade::getTicket($info);
//
//        if (
//            ($searchTicket->status === Ticket::WAIT_FOR_ADMIN_ANSWER && Auth::user()->isAdmin())
//            || ($searchTicket->status === Ticket::WAIT_FOR_USER_ANSWER && !Auth::user()->isAdmin())
//        ) {
//            $this->repo->updateTicketStatus($ticket->getTicketId(), Ticket::PROCESS_STATUS);
//        }

        return $this->messageRepo->getMessagesForTicket($ticket);
    }
}
