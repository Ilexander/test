<?php

namespace App\Services\Ticket\TicketMessage;

use App\Http\Requests\Ticket\TicketUpdateInterface;
use App\Http\Requests\TicketMessage\TicketMessageAllInterface;
use App\Http\Requests\TicketMessage\TicketMessageCreateInterface;
use App\Http\Requests\TicketMessage\TicketMessageDeleteInterface;
use App\Http\Requests\TicketMessage\TicketMessageInfoInterface;
use App\Http\Requests\TicketMessage\TicketMessageTicketInterface;
use App\Http\Requests\TicketMessage\TicketMessageUpdateInterface;
use App\Http\Requests\TicketMessage\TicketMessageUserInterface;
use Illuminate\Support\Facades\Facade;

/**
 * Class TicketMessageFacade
 * @package App\Services\Ticket\TicketMessage
 *
 * @method static add(TicketMessageCreateInterface $create)
 * @method static read(TicketMessageInfoInterface $info)
 * @method static update(TicketMessageUpdateInterface $update)
 * @method static delete(TicketMessageDeleteInterface $delete)
 * @method static list(TicketMessageAllInterface $all)
 * @method static user(TicketMessageUserInterface $user)
 * @method static ticket(TicketMessageTicketInterface $ticket)
 */
class TicketMessageFacade extends Facade
{
    protected static function getFacadeAccessor() { return 'ticketMessageService'; }
}