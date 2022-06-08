<?php

namespace App\Interfaces\Repositories;

use App\Http\Requests\Ticket\TicketAllInterface;
use App\Http\Requests\Ticket\TicketCreateInterface;
use App\Http\Requests\Ticket\TicketDeleteInterface;
use App\Http\Requests\Ticket\TicketInfoInterface;
use App\Http\Requests\Ticket\TicketUpdateInterface;
use App\Http\Requests\Ticket\TicketUserInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface TicketInterface
 * @package App\Interfaces\Repositories
 */
interface TicketInterface
{
    /**
     * @param TicketCreateInterface $create
     * @return Model
     */
    public function saveTicker(TicketCreateInterface $create): Model;

    /**
     * @param TicketInfoInterface $info
     * @return Model
     */
    public function getTicker(TicketInfoInterface $info): Model;

    /**
     * @param TicketAllInterface $all
     * @return Collection
     */
    public function getTickerList(TicketAllInterface $all): Collection;

    /**
     * @param TicketUpdateInterface $update
     * @return bool
     */
    public function updateTicket(TicketUpdateInterface $update): bool;

    /**
     * @param TicketDeleteInterface $delete
     * @return bool
     */
    public function deleteTicket(TicketDeleteInterface $delete): bool;

    /**
     * @param TicketUserInterface $user
     * @return Collection
     */
    public function userTicket(TicketUserInterface $user): Collection;

    /**
     * @param int $ticketId
     * @param int $statusId
     * @return bool
     */
    public function updateTicketStatus(int $ticketId, int $statusId): bool;

    /**
     * @param int|null $user_id
     * @return object
     */
    public function statusesStatistic(?int $user_id): object;

    /**
     * @param TicketInfoInterface $importantChange
     * @return bool
     */
    public function importantChangeTicket(TicketInfoInterface $importantChange): bool;
}
