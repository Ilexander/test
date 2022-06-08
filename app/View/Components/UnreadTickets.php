<?php

namespace App\View\Components;

use App\Http\Requests\Ticket\TicketAllRequest;
use App\Models\Ticket;
use App\Services\Ticket\TicketFacade;
use Illuminate\View\Component;

class UnreadTickets extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $all = new TicketAllRequest();
        $all->merge([
            'filter_status' => Ticket::WAIT_FOR_ADMIN_ANSWER
        ]);
        $ticket = TicketFacade::getAllTickets($all);

        return view('components.unread-tickets', [
            'count' => $ticket->count()
        ]);
    }
}
