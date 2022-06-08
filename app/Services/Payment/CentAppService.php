<?php

namespace App\Services\Payment;

use App\DTO\Payment\RequestSuccessDTO;
use App\DTO\Payment\ResponseDTO;
use App\Exceptions\PaymentServerAuthorizationException;
use App\Exceptions\PaymentServerConnectionException;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CentAppService
 * @package App\Services\Payment
 */
class CentAppService extends BaseService
{

    /**
     * @param Payment $payment
     * @param Transaction $transaction
     * @return false|resource
     */
    protected function generateRequest(Payment $payment, Transaction $transaction)
    {
        $body= [
            'amount' => $transaction->amount,
            'shop_id' => $payment->client_id,
            'currency_in' => $transaction->currency->description,
            'order_id' => $transaction->order_id,
            'custom' => $transaction->system_hash,
        ];

        $request = curl_init(config('payments.cent_app.create_bill_url'));
        curl_setopt($request, CURLOPT_POSTFIELDS, $body);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($request, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($request, CURLOPT_SSL_VERIFYHOST,  2);
        curl_setopt($request, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer '.$payment->secret_key
        ]);

        return $request;
    }

    /**
     * @param $request
     * @return RequestSuccessDTO
     * @throws PaymentServerAuthorizationException
     * @throws PaymentServerConnectionException
     */
    protected function executeRequest($request): RequestSuccessDTO
    {
        $response = curl_exec($request);

        if (gettype($response) === 'boolean') {
            throw new PaymentServerConnectionException("Cent app service connection");
        }

        $response = json_decode($response, true);

        if (isset($response['message']) && $response['message'] === 'Unauthenticated.') {
            throw new PaymentServerAuthorizationException("Cent app authorization error");
        }

        return new RequestSuccessDTO($response['bill_id'], $response['link_page_url'], 'cent_app');
    }

    /**
     * @param Transaction $transaction
     * @param string $expectedStatus
     * @return bool
     */
    protected function executeStatusCheckRequest(Transaction $transaction, string $expectedStatus): bool
    {
        $request = curl_init(config('payments.cent_app.status_bill_url').$transaction->transaction_id);

        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($request, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($request, CURLOPT_SSL_VERIFYHOST,  2);
        curl_setopt($request, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer '.$transaction->payment->secret_key
        ]);

        $response = json_decode(curl_exec($request));

        return $response->status !== $expectedStatus;
    }

    /**
     * @param array $serviceResponseData
     * @return ResponseDTO
     */
    public function success(array $serviceResponseData): ResponseDTO
    {
        /** @var  Transaction $transaction */
        $transaction = $this->getTransaction($serviceResponseData, [Transaction::STATUS_NEW, Transaction::STATUS_FAILED]);

        if (
            $this->makeSignature($transaction) !== $serviceResponseData['SignatureValue']
            || $this->executeStatusCheckRequest($transaction, 'SUCCESS')
        ) {
            return $this->redirectToStatus(false);
        }

        $transaction->status = Transaction::STATUS_SUCCESS;
        $transaction->save();

        return $this->redirectToStatus(true);
    }

    /**
     * @param array $serviceResponseData
     * @return ResponseDTO
     */
    public function fail(array $serviceResponseData): ResponseDTO
    {
        /** @var  Transaction $transaction */
        $transaction = $this->getTransaction($serviceResponseData, [Transaction::STATUS_NEW]);

        if (
            $this->makeSignature($transaction) !== $serviceResponseData['SignatureValue']
            || $this->executeStatusCheckRequest($transaction, 'FAIL')
        ) {
            return $this->redirectToStatus(false);
        }

        $transaction->status = Transaction::STATUS_FAILED;
        $transaction->save();

        return $this->redirectToStatus(false);
    }

    /**
     * @param Transaction $transaction
     * @return string
     */
    private function makeSignature(Transaction $transaction): string
    {
        return strtoupper(md5($transaction->amount.".00:".$transaction->order_id.":".$transaction->payment->secret_key));
    }

    /**
     * @param array $serviceResponseData
     * @param array $statuses
     * @return Model
     */
    private function getTransaction(array $serviceResponseData, array $statuses): Model
    {
        return Transaction::query()
            ->select('transactions.*')
            ->with('payment')
            ->where('transactions.system_hash', $serviceResponseData['custom'])
            ->where('transactions.order_id', $serviceResponseData['InvId'])
            ->join(
                (new Payment())->getTable().' as p',
                'transactions.payment_id', '=', 'p.id'
            )
            ->where('p.type', "centAppService")
            ->whereIn('transactions.status', $statuses)
            ->firstOrFail();
    }
}
