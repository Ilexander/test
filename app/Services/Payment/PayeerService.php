<?php

namespace App\Services\Payment;

use App\DTO\Payment\RequestSuccessDTO;
use App\DTO\Payment\ResponseDTO;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;

class PayeerService extends BaseService
{

    protected function generateRequest(Payment $payment, Transaction $transaction)
    {
        $m_shop    = $payment->client_id;
        $m_orderid = md5(time().$transaction->amount);
        $m_amount  = number_format($transaction->amount, 2, '.', '');
        $m_curr    = 'USD';
        $m_desc    = base64_encode("Balance recharge - ".  $transaction->payer_email);

        $m_key     = $payment->secret_key;
        $arHash = [
            $m_shop,
            $m_orderid,
            $m_amount,
            $m_curr,
            $m_desc
        ];

        $arHash[] = $m_key;
        $sign = strtoupper(hash('sha256', implode(':', $arHash)));

        $transaction->transaction_id = $m_orderid;
        $transaction->system_hash = $sign;
        $transaction->save();

        $paramList = [
            "m_shop"    => $m_shop,
            "m_orderid" => $m_orderid,
            "m_amount" 	=> $m_amount,
            "m_curr" 	=> $m_curr,
            'm_desc'    => $m_desc,
            'm_sign'    => $sign,
        ];

        return [
            "action_url"    => config('payments.payeer.create_bill_url'),
            "paramList" 	=> $paramList,
        ];

    }

    protected function executeRequest($request): RequestSuccessDTO
    {
        return new RequestSuccessDTO(
            $request['paramList']['m_orderid'],
            $request['action_url'],
            'payeer',
            json_encode($request['paramList'])
        );
    }

    protected function executeStatusCheckRequest(Transaction $transaction, string $expectedStatus): bool
    {
        // TODO: Implement executeStatusCheckRequest() method.
    }

    public function success(array $serviceResponseData): ResponseDTO
    {
        try {
            if ( $this->checkFiledExisting($serviceResponseData) ) {
                return new ResponseDTO(true, 'Create order', route('order.create'));
            }

            /** @var Transaction $transaction */
            $transaction = $this->checkTransaction(strip_tags($serviceResponseData['m_orderid']));

            if (!$transaction) {
                return new ResponseDTO(true, 'Create order', route('order.create'));
            }

            if(
                $this->checkTransactionValid($transaction->payment->secret_key, $serviceResponseData)
                && $serviceResponseData['m_status'] == 'success'
                && $serviceResponseData['m_shop'] == $transaction->payment->client_id
            ) {
                $transaction->status = Transaction::STATUS_SUCCESS;
                $transaction->save();

                return $this->redirectToStatus(true);
            } else {

                $transaction->status = Transaction::STATUS_FAILED;
                $transaction->save();

                return $this->redirectToStatus(false);
            }
        } catch (\Exception $exception) {

            return $this->redirectToStatus(false);
        }
    }

    public function fail(array $serviceResponseData): ResponseDTO
    {
        try {
            if ( $this->checkFiledExisting($serviceResponseData) ) {
                return new ResponseDTO(true, 'Create order', route('order.create'));
            }

            /** @var Transaction $transaction */
            $transaction = $this->checkTransaction(strip_tags($serviceResponseData['m_orderid']));

            if (!$transaction) {
                return new ResponseDTO(true, 'Create order', route('order.create'));
            }

            if(
                $this->checkTransactionValid($transaction->payment->secret_key, $serviceResponseData)
                && $serviceResponseData['m_status'] !== 'success'
                && $serviceResponseData['m_shop'] == $transaction->payment->client_id
            ) {
                $transaction->status = Transaction::STATUS_FAILED;
                $transaction->save();
            }

            return $this->redirectToStatus(false);
        } catch (\Exception $exception) {

            return $this->redirectToStatus(false);
        }
    }

    private function checkFiledExisting(array $serviceResponseData): bool
    {
        return (
            !isset($serviceResponseData['m_orderid'])
            || !isset($serviceResponseData['m_shop'])
            || !isset($serviceResponseData['m_amount'])
            || !isset($serviceResponseData['m_status'])
        );
    }

    private function checkTransactionValid(string $secret_key, array $serviceResponseData): bool
    {
        $arHash = [
            $serviceResponseData['m_operation_id'],
            $serviceResponseData['m_operation_ps'],
            $serviceResponseData['m_operation_date'],
            $serviceResponseData['m_operation_pay_date'],
            $serviceResponseData['m_shop'],
            $serviceResponseData['m_orderid'],
            $serviceResponseData['m_amount'],
            $serviceResponseData['m_curr'],
            $serviceResponseData['m_desc'],
            $serviceResponseData['m_status']
        ];

        if (isset($serviceResponseData['m_params'])) {
            $arHash[] = $serviceResponseData['m_params'];
        }

        $arHash[] = $secret_key;

        return ( strtoupper(hash('sha256', implode(':', $arHash)))) == $serviceResponseData['m_sign'];
    }

    private function checkTransaction(string $tx_order_id)
    {
        return Transaction::query()
            ->select('transactions.*')
            ->with('payment')
            ->where('transactions.transaction_id', $tx_order_id)
            ->join(
                (new Payment())->getTable().' as p',
                'transactions.payment_id', '=', 'p.id'
            )
            ->where('p.type', "payeerService")
            ->firstOrFail();
    }
}