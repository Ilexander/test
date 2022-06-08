<?php

namespace App\Http\Requests\Transaction;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property integer|null $status_filter
 * @property integer|null $id_filter
 * @property string|null $user_filter
 * @property string|null $transaction_id_filter
 * @property integer|null $payment_filter
 * @property float|null $amount_filter
 * @property string|null $transaction_fee_filter
 * @property integer|null $limit
 */
class TransactionAllRequest extends FormRequest implements TransactionAllInterface
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        /** @var User $user */
        $user = Auth::user();

        return $user->hasPermissionTo(Transaction::MODEL_ROUTE_PERMISSION);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "id_filter"   => 'nullable|numeric',
            "user_filter"   => 'nullable|string',
            "transaction_id_filter"   => 'nullable|string',
            "payment_filter"   => 'nullable',
            "amount_filter" => 'nullable|numeric',
            "transaction_fee_filter" => 'nullable|string',
            "status_filter" => 'nullable',
            "limit" => 'nullable|numeric'
        ];
    }

    public function getLimit(): ?int
    {
        return $this->limit;
    }

    public function getUserId(): ?int
    {
        return (Auth::user() && !Auth::user()->isAdmin()) ? Auth::user()->id : null;
    }

    public function getStatus(): ?int
    {
        return $this->status_filter;
    }

    public function getIdFilter(): ?int
    {
        return $this->id_filter;
    }

    public function getUserFilter(): ?string
    {
        return $this->user_filter;
    }

    public function getTransactionIdFilter(): ?string
    {
        return $this->transaction_id_filter;
    }

    public function getPaymentFilter(): ?int
    {
        return $this->payment_filter;
    }

    public function getAmountFilter(): ?float
    {
        return $this->amount_filter;
    }

    public function getTransactionFeeFilter(): ?string
    {
        return $this->transaction_fee_filter;
    }
}
