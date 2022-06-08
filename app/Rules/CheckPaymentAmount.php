<?php

namespace App\Rules;

use App\Models\Payment;
use App\Models\Settings;
use App\Models\Transaction;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class CheckPaymentAmount implements Rule
{
    private ?int $payment_id = null;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(?int $payment_id)
    {
        $this->payment_id = $payment_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        /** @var Payment $payment */
        $payment = Payment::query()->find($this->payment_id);

        if (($payment->min > (int)$value) || ((int)$value > $payment->max)) {
            return false;
        }

        if ($payment->type === 'customPaypalService') {

            $paypalTransactionLimitFactor = Settings::query()
                ->where('page_name', 'paypal_settings')
                ->where('field_name', 'paypal_transaction_limit_factor')
                ->first();

            if ($paypalTransactionLimitFactor && $paypalTransactionLimitFactor->field_value < (int)$value) {
                return false;
            }

            $moreInformation = json_decode(Auth::user()->more_information, true);

            $ignorePaypalMinimumAmountSum = true;

            if (
                !isset($moreInformation['ignore_paypal_minimum_amount_sum'])
                || $moreInformation['ignore_paypal_minimum_amount_sum'] !== 'on'
            ) {
                $ignorePaypalMinimumAmountSum = false;
            }


            $transactionsAmountSum = Transaction::query()
                ->where('payment_id', '!=', $payment->id)
                ->where('user_id', Auth::user()->id)
                ->where('status', Transaction::STATUS_SUCCESS)
                ->get()
                ->sum('amount');

            $minimalAmountSum = 50;

            $paypalMinimalClientAmountSum = Settings::query()
                ->where('page_name', 'paypal_settings')
                ->where('field_name', 'paypal_minimal_client_amount_sum')
                ->first();

            if ($paypalMinimalClientAmountSum) {
                $minimalAmountSum = (int)$paypalMinimalClientAmountSum->field_value;
            }

            if($transactionsAmountSum < $minimalAmountSum && !$ignorePaypalMinimumAmountSum) {
                return false;
            }

            $todayAmount = Transaction::query()
                ->where('payment_id', $payment->id)
                ->where('status', Transaction::STATUS_SUCCESS)
                ->whereDate('created_at', date('Y-m-d'))
                ->get()
                ->sum('amount');

            $limit = 200;

            $paypalLimitSum = Settings::query()
                ->where('page_name', 'paypal_settings')
                ->where('field_name', 'paypal_day_limit_factor')
                ->first();

            if ($paypalLimitSum) {
                $limit = (int) $paypalLimitSum->field_value;
            }

            if ($limit < ($todayAmount + (int)$value)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'Wrong amount';
    }
}
