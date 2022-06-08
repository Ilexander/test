<?php

namespace App\View\Components;

use App\Http\Requests\Ticket\TicketAllRequest;
use App\Models\Ticket;
use App\Services\Ticket\TicketFacade;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class UnreadMessage extends Component
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
            'filter_status' => (Auth::user()->isAdmin() ? Ticket::WAIT_FOR_ADMIN_ANSWER : Ticket::WAIT_FOR_USER_ANSWER)
        ]);
        $ticket = TicketFacade::getAllTickets($all);

        return view('components.unread-message', [
            'count' => $ticket->count()
        ]);
    }

}
