<?php

namespace App\Services\Ticket;

use App\Http\Requests\Ticket\TicketAllInterface;
use App\Http\Requests\Ticket\TicketCreateInterface;
use App\Http\Requests\Ticket\TicketDeleteInterface;
use App\Http\Requests\Ticket\TicketInfoInterface;
use App\Http\Requests\Ticket\TicketUpdateInterface;
use App\Http\Requests\Ticket\TicketUserInterface;
use Illuminate\Support\Facades\Facade;

/**
 * Class TicketFacade
 * @package App\Services\Ticket
 *
 * @method static addTicket(TicketCreateInterface $create)
 * @method static updateTicket(TicketUpdateInterface $update)
 * @method static deleteTicket(TicketDeleteInterface $delete)
 * @method static getTicket(TicketInfoInterface $info)
 * @method static getAllTickets(TicketAllInterface $all)
 * @method static userTicket(TicketUserInterface $user)
 * @method static statusesStatistic(?int $user_id)
 * @method static importantChangeTicket(TicketInfoInterface $importantChange)
 * @method static updateStatus(int $ticket_id, int $status_id)
 */

class TicketFacade extends Facade
{
    protected static function getFacadeAccessor() { return 'ticketService'; }
}
