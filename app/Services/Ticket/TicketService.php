<?php

namespace App\Services\Ticket;

use App\Http\Requests\Ticket\TicketAllInterface;
use App\Http\Requests\Ticket\TicketCreateInterface;
use App\Http\Requests\Ticket\TicketDeleteInterface;
use App\Http\Requests\Ticket\TicketInfoInterface;
use App\Http\Requests\Ticket\TicketUpdateInterface;
use App\Http\Requests\Ticket\TicketUserInterface;
use App\Http\Requests\TicketMessage\TicketMessageCreateRequest;
use App\Interfaces\Repositories\TicketInterface;
use App\Services\Ticket\TicketMessage\TicketMessageFacade;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TicketService
 * @package App\Services\Ticket
 */
class TicketService
{
    protected TicketInterface $repo;

    public function __construct(TicketInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param TicketCreateInterface $create
     * @return bool
     */
    public function addTicket(TicketCreateInterface $create): bool
    {
        $ticket = $this->repo->saveTicker($create);

        try {
            $message = new TicketMessageCreateRequest();
            $message->merge([
                'ticket_id' => $ticket->id,
                'message' => $create->getDescription()
            ]);
            TicketMessageFacade::add($message);

            return true;
        } catch (\Throwable $exception) {
            return false;
        }
    }

    /**
     * @param TicketUpdateInterface $update
     * @return bool
     */
    public function updateTicket(TicketUpdateInterface $update): bool
    {
        return $this->repo->updateTicket($update);
    }

    /**
     * @param TicketDeleteInterface $delete
     * @return bool
     */
    public function deleteTicket(TicketDeleteInterface $delete): bool
    {
        return $this->repo->deleteTicket($delete);
    }

    /**
     * @param TicketInfoInterface $info
     * @return Model
     */
    public function getTicket(TicketInfoInterface $info): Model
    {
        return $this->repo->getTicker($info);
    }

    /**
     * @param TicketAllInterface $all
     * @return Collection
     */
    public function getAllTickets(TicketAllInterface $all): Collection
    {
        return $this->repo->getTickerList($all);
    }

    /**
     * @param TicketUserInterface $user
     * @return Collection
     */
    public function userTicket(TicketUserInterface $user): Collection
    {
        return $this->repo->userTicket($user);
    }

    /**
     * @param int|null $user_id
     * @return object
     */
    public function statusesStatistic(?int $user_id): object
    {
        return $this->repo->statusesStatistic($user_id);
    }

    public function importantChangeTicket(TicketInfoInterface $importantChange): bool
    {
        return $this->repo->importantChangeTicket($importantChange);
    }

    public function updateStatus(int $ticket_id, int $status_id): bool
    {
        return $this->repo->updateTicketStatus($ticket_id, $status_id);
    }
}
