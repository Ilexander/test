<?php

namespace App\Http\Requests\Ticket;

interface TicketUpdateInterface
{
    public function getId(): int;

    public function getSubject(): string;

    public function getDescription(): string;

    public function getUserId(): int;
}