<?php

namespace App\DTO\Payment;

class ResponseDTO
{
    private bool $status;
    private string $message;
    private string $redirectUrl;

    public function __construct(
        bool $status,
        string $message,
        string $redirectUrl
    ) {
        $this->status = $status;
        $this->message = $message;
        $this->redirectUrl = $redirectUrl;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getRedirectUrl(): string
    {
        return $this->redirectUrl;
    }

}