<?php

namespace App\Http\Requests\Ticket;

interface TicketAllInterface
{
    public function getUserId(): ?int;
    public function getStartDate(): ?string;
    public function getEndDate(): ?string;
    public function getSearch(): ?string;
    public function getFilterStatus(): ?int;
    public function getFilterImportant(): ?int;
}
