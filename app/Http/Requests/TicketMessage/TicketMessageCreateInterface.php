<?php

namespace App\Http\Requests\TicketMessage;

interface TicketMessageCreateInterface
{
    public function getTicketId(): int;

    public function getMessage(): string;
}