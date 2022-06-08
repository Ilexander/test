<?php

namespace App\Services\Payment;

use App\DTO\Payment\RequestSuccessDTO;
use App\DTO\Payment\ResponseDTO;
use App\Models\Payment;
use App\Models\Settings;
use App\Models\Transaction;
use App\Models\User;

class СustomPaypalService extends BaseService
{
    private string $apiUrl = 'https://au107.dock-automate.xyz/p2';
    private ?string $transactionId = null;

    protected function generateRequest(Payment $payment, Transaction $transaction)
    {
        $c = new PPGate\PayPalGatewayClient($this->apiUrl, $payment->client_id, $payment->secret_key);

        $this->transactionId = time();

        return $c->getCheckoutUrl([
            'transactionId' => $this->transactionId,
            'amount' => $transaction->amount,
            'currency' => 'USD'
        ]);
    }

    protected function executeRequest($request): RequestSuccessDTO
    {
        return new RequestSuccessDTO(
            $this->transactionId,
            $request->data->redirectUrl,
            "custom_paypal"
        );
    }

    protected function executeStatusCheckRequest(Transaction $transaction, string $expectedStatus): bool
    {
        // TODO: Implement executeStatusCheckRequest() method.
    }

    public function success(array $serviceResponseData): ResponseDTO
    {
        // TODO: Implement success() method.
    }

    public function fail(array $serviceResponseData): ResponseDTO
    {
        // TODO: Implement fail() method.
    }

    public function checkTransactionStatuses(): void
    {
        $payment = Payment::query()
            ->where('type', 'customPaypalService')
            ->first();

        if ($payment) {
            $transactions = Transaction::query()
                ->where('payment_id', $payment->id)
                ->where('status', Transaction::STATUS_NEW)
                ->where('transaction_id', '!=', "")
                ->whereNotNull('transaction_id')
                ->get();

            if (!$transactions->isEmpty()) {
                $c = new PPGate\PayPalGatewayClient($this->apiUrl, $payment->client_id, $payment->secret_key);

                foreach ($transactions as $transaction) {

                    $result = $c->getTransactionInfo($transaction->transaction_id);

                    if ($result->data->status == 10) {
                        /** @var User $user */
                        $user = User::query()->where('id', $transaction->user_id)->first();

                        if ($user) {
                            User::query()
                                ->where('id', $transaction->user_id)
                                ->update([
                                    'balance' => $user->balance + $transaction->amount
                                ]);

                            Transaction::query()
                                ->where('id', $transaction->id)
                                ->update([
                                    'status' => Transaction::STATUS_SUCCESS
                                ]);
                        }
                    }
                }
            }
        }
    }

    public function getDailyLimit()
    {
        $payment = Payment::query()
            ->where('type', 'customPaypalService')
            ->first();

        if ($payment) {
            $c = new PPGate\PayPalGatewayClient($this->apiUrl, $payment->client_id, $payment->secret_key);

            $limits = $c->getLimits();

            if ($limits) {

                Settings::query()
                    ->where('page_name', 'paypal_settings')
                    ->where('field_name', 'paypal_day_limit_factor')
                    ->update([
                        'field_value' => $limits->data->daily_limit
                    ]);
            }
        }
    }
}
