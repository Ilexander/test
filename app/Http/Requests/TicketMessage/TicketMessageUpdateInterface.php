<?php

namespace App\Http\Requests\TicketMessage;

interface TicketMessageUpdateInterface
{
    public function getId(): int;

    public function getMessage(): string;
}