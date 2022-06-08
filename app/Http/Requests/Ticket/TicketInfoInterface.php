<?php

namespace App\Http\Requests\Ticket;

interface TicketInfoInterface
{
    public function getId(): int;
    public function getUserId(): int;
}