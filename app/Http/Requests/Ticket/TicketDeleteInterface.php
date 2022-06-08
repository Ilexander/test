<?php

namespace App\Http\Requests\Ticket;

interface TicketDeleteInterface
{
    public function getId(): int;
    public function getUserId(): int;
}