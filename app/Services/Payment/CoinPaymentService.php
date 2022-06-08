<?php

namespace App\Services\Payment;

use App\DTO\Payment\RequestSuccessDTO;
use App\DTO\Payment\ResponseDTO;
use App\Exceptions\PaymentServerAuthorizationException;
use App\Exceptions\PaymentServerConnectionException;
use App\Helpers\CoinPayment\CoinPaymentsHelper;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class CoinPaymentService extends BaseService
{

    /**
     * @throws PaymentServerAuthorizationException
     */
    protected function generateRequest(Payment $payment, Transaction $transaction)
    {
        $data_create_transaction = array(
            "currency1"        => 'USD',
            "currency2"        => $transaction->currency->description,
            "buyer_email"      => $transaction->payer_email,
            "buyer_name"       => Auth::user()->first_name . ' ' . Auth::user()->last_name,
            "item_number"      => "#".rand(10000,99999999),
            "item_name"        => 'Deposit_to_'.config('app.name'). ' ('.$transaction->payer_email.')',
            //            "invoice"          => convert_timezone(NOW, 'user'),
            "invoice"          => 'some invoice',
            "amount"           => $transaction->amount,
        );

        $payment_lib = new CoinPaymentsHelper($payment->secret_key, $payment->client_id);

        $result = $payment_lib->create_payment($data_create_transaction);
        if (!$result) {
            throw new PaymentServerConnectionException("Coin payment service connection");
        }

        if ($result->status == 'error') {
            throw new PaymentServerAuthorizationException($result->message);
        }

        if ($result->status == 'success') {
            $transaction->transaction_id = $result->data["txn_id"];
            $transaction->save();

            return $result;
        }

        return false;
    }

    protected function executeRequest($request): RequestSuccessDTO
    {
        return new RequestSuccessDTO($request->data["txn_id"], $request->data["checkout_url"], 'coin_payments');
    }

    protected function executeStatusCheckRequest(Transaction $transaction, string $expectedStatus): bool
    {
        // TODO: Implement executeStatusCheckRequest() method.
    }

    public function success(array $serviceResponseData): ResponseDTO
    {
        $payment = Payment::query()
            ->where('type', 'coinPaymentsService')
            ->first();

        $transactions = Transaction::query()
            ->where('status', Transaction::STATUS_NEW)
            ->where('transaction_id', "!=", "")
            ->whereNotNull('transaction_id')
            ->get();

        if ($transactions && $payment) {
            $payment_lib = new CoinPaymentsHelper($payment->secret_key, $payment->client_id);
            /**
             * @var  int $key
             * @var  Transaction $transaction
             */
            foreach ($transactions as $transaction) {

                $result = $payment_lib->get_transaction_detail_info($transaction->transaction_id);
                if (isset($result->status) && $result->status == 'error' && isset($result->message)) {
                    //TODO write error message
                }
                if ($result->status == 'success') {
                    if ($result->data['status'] == 100) {
                        $transaction->status = Transaction::STATUS_SUCCESS;
                        $transaction->save();

                        return $this->redirectToStatus(true);
                    }

                    if ($result->data['status'] == -1) {
                        $transaction->status = Transaction::STATUS_FAILED;
                        $transaction->save();

                        return $this->redirectToStatus(false);
                    }
                }
            }
        }

        return $this->redirectToStatus(false);
    }

    public function fail(array $serviceResponseData): ResponseDTO
    {
        // TODO: Implement fail() method.
    }
}
