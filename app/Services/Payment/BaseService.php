<?php

namespace App\Services\Payment;

use App\DTO\Payment\RequestSuccessDTO;
use App\DTO\Payment\ResponseDTO;
use App\Models\Payment;
use App\Models\Transaction;

abstract class BaseService
{
    abstract protected function generateRequest(Payment $payment, Transaction $transaction);

    abstract protected function executeRequest($request): RequestSuccessDTO;

    abstract protected function executeStatusCheckRequest(Transaction $transaction, string $expectedStatus): bool;

    abstract public function success(array $serviceResponseData): ResponseDTO;

    abstract public function fail(array $serviceResponseData): ResponseDTO;

    public function makeRequest(Payment $payment, Transaction $transaction): RequestSuccessDTO
    {
        $request = $this->generateRequest($payment, $transaction);

        return $this->executeRequest($request);
    }

    protected function redirectToStatus(bool $status): ResponseDTO
    {
        if ($status) {
            return new ResponseDTO(true, 'Payment Success', 'some mobile route');
        }

        return new ResponseDTO(true, 'Payment Fail', 'some mobile route');
    }

    protected function redirectToFail(): ResponseDTO
    {
        return new ResponseDTO(true, 'Payment Fail', 'some mobile route');
    }
}
