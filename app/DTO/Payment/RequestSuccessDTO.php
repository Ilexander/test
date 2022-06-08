<?php

namespace App\DTO\Payment;

class RequestSuccessDTO
{
    private string $transactionId;
    private string $redirectUrl;
    private string $paymentName;
    private ?string $urlData;

    /**
     * RequestSuccessDTO constructor.
     * @param string $transactionId
     * @param string $redirectUrl
     * @param string $paymentName
     * @param string|null $urlData
     */
    public function __construct(
        string $transactionId,
        string $redirectUrl,
        string $paymentName,
        string $urlData = null
    ) {
        $this->transactionId = $transactionId;
        $this->redirectUrl = $redirectUrl;
        $this->paymentName = $paymentName;
        $this->urlData = $urlData;
    }

    public function getTransactionId(): string
    {
        return $this->transactionId;
    }

    public function getRedirectUrl(): string
    {
        return $this->redirectUrl;
    }

    public function getUrlData(): ?string
    {
        return $this->urlData;
    }

    public function getPaymentName(): string
    {
        return $this->paymentName;
    }
}