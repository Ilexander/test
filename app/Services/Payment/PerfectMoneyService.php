<?php

namespace App\Services\Payment;

use App\DTO\Payment\RequestSuccessDTO;
use App\DTO\Payment\ResponseDTO;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Support\Facades\Config;

class PerfectMoneyService extends BaseService
{
    protected function generateRequest(Payment $payment, Transaction $transaction): array
    {
        $amount = number_format($transaction->amount, 2, '.', ',');

        $perfectmoney = array(
            'PAYMENT_AMOUNT'    => $amount,
            'PAYEE_ACCOUNT' 	=> $transaction->payment->client_id,
            'PAYEE_NAME' 		=> config('app.name'),
            'PAYMENT_UNITS' 	=> "USD",
            'STATUS_URL' 		=> route('user.dashboard', ['language' => Config::get('app.locale')]),
            'PAYMENT_URL' 		=> route('user.dashboard', ['language' => Config::get('app.locale')]),
            'NOPAYMENT_URL' 	=> route('user.dashboard', ['language' => Config::get('app.locale')]),
            'BAGGAGE_FIELDS' 	=> 'IDENT',
            'ORDER_NUM' 		=> 1,
            'PAYMENT_ID' 		=> $transaction->payment_id,
            'CUST_NUM' 		    => "USERID" . rand(10000,99999999),
            'memo' 		        => "Balance recharge - ".  $transaction->payer_email,

        );
        $tnx_id = $perfectmoney['PAYMENT_ID'].':'.$perfectmoney['PAYEE_ACCOUNT'].':'. $amount.':'.$perfectmoney['PAYMENT_UNITS'];

        return [
            'action_url' => config('payments.perfect_money.create_bill_url'),
            'transaction_id' => sha1($tnx_id),
            'param_list' => $perfectmoney
        ];
    }

    protected function executeRequest($request): RequestSuccessDTO
    {
        return new RequestSuccessDTO(
            $request['transaction_id'],
            $request['action_url'],
            'perfect_money',
            json_encode($request['param_list'])
        );
    }

    protected function executeStatusCheckRequest(Transaction $transaction, string $expectedStatus): bool
    {
        // TODO: Implement executeStatusCheckRequest() method.
    }

    public function success(array $serviceResponseData): ResponseDTO
    {
        if (!isset($serviceResponseData['PAYMENT_BATCH_NUM'])) {
            return new ResponseDTO(true, 'Create order', route('order.create'));
        }
        $tnx_id = $serviceResponseData['PAYMENT_ID'].':'.
            $serviceResponseData['PAYEE_ACCOUNT'].':'.
            $serviceResponseData['PAYMENT_AMOUNT'].':'.
            $serviceResponseData['PAYMENT_UNITS'];

        /** @var Transaction $transaction */
        $transaction = Transaction::query()
            ->select('transactions.*')
            ->where('transactions.transaction_id', sha1($tnx_id))
            ->where('transactions.status', Transaction::STATUS_NEW)
            ->join(
                (new Payment())->getTable().' as p',
                'transactions.payment_id', '=', 'p.id'
            )
            ->where('p.type', 'perfectMoneyService')
            ->first();

        if (!$transaction) {
            return new ResponseDTO(true, 'Create order', route('order.create'));
        }

        if (
            $serviceResponseData['PAYEE_ACCOUNT'] == $transaction->payment->client_id
            && $transaction->amount == $serviceResponseData['PAYMENT_AMOUNT']
            && $this->check_v2_hash($transaction->payment->secret_key, $serviceResponseData)
        ) {
            $transaction->status = Transaction::STATUS_SUCCESS;
            $transaction->transaction_id = $serviceResponseData['PAYMENT_BATCH_NUM'];
            $transaction->save();

            return $this->redirectToStatus(true);
        } else {
            $transaction->status = Transaction::STATUS_FAILED;
            $transaction->save();
        }

        return $this->redirectToStatus(false);
    }

    public function fail(array $serviceResponseData): ResponseDTO
    {
        return new ResponseDTO(
            true,
            'Payment procedure failed',
            route('index', ['language' => app()->getLocale()])
        );
    }

    private function check_v2_hash($perfectmoney_alternate_passphrase = "", $post): bool
    {
        $alternate_passphrase = strtoupper(md5($perfectmoney_alternate_passphrase));
        $string= $post['PAYMENT_ID'].':'.$post['PAYEE_ACCOUNT'].':'. $post['PAYMENT_AMOUNT'].':'.$post['PAYMENT_UNITS'].':'. $post['PAYMENT_BATCH_NUM'].':'. $post['PAYER_ACCOUNT'].':'.$alternate_passphrase.':'. $post['TIMESTAMPGMT'];
        $hash = strtoupper(md5($string));

        return $hash == $post['V2_HASH'];
    }
}
