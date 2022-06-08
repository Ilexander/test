<?php

namespace App\Http\Requests\Ticket;

interface TicketStatusUpdateInterface
{
    public function getTicketId(): int;

    public function getStatusId(): int;
}
