<?php

namespace App\Http\Requests\Ticket;

interface TicketCreateInterface
{
    /**
     * @return string
     */
    public function getSubject(): string;

    /**
     * @return string
     */
    public function getDescription(): string;

    /**
     * @return string|null
     */
    public function getOrderId(): ?string;

    /**
     * @return string|null
     */
    public function getTransactionId(): ?string;

    /**
     * @return string|null
     */
    public function getPayment(): ?string;

    /**
     * @return string|null
     */
    public function getRequest(): ?string;
}
