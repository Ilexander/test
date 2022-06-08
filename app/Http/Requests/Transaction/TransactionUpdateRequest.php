<?php

namespace App\Http\Requests\Transaction;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property string|null payer_email
 * @property int|null payment_id
 * @property string|null transaction_id
 * @property int|null txn_fee
 * @property int|null amount
 * @property int id
 * @property int|null status
 * @property int|null user_id
 * @property string|null system_hash
 * @property int|null currency_id
 * @property string|null note
 */
class TransactionUpdateRequest extends FormRequest implements TransactionUpdateInterface
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
            'id'                => 'required|exists:transactions,id',
            'payer_email'       => 'nullable|email',
            'payment_id'        => 'nullable|exists:payments,id',
            'transaction_id'    => 'nullable|string',
            'txn_fee'           => 'nullable|numeric',
            'amount'            => 'nullable|numeric',
            'status'            => 'nullable|in:'.implode(',', array_keys(Transaction::STATUS_LIST)),
            'system_hash'       => 'nullable|string',
            'currency_id'       => 'nullable|exists:currencies,id',
            'user_id'           => 'nullable|exists:users,id',
            'note'              => 'nullable|string'
        ];
    }
    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function getPayerEmail(): ?string
    {
        return $this->payer_email;
    }

    public function getPaymentId(): ?int
    {
        return $this->payment_id;
    }

    public function getTransactionId(): ?string
    {
        return $this->transaction_id;
    }

    public function getTxnFee(): ?int
    {
        return $this->txn_fee;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function getSystemHash(): ?string
    {
        return $this->system_hash;
    }

    public function getCurrencyId(): ?int
    {
        return $this->currency_id;
    }

    public function getNote(): ?string
    {
        return strip_tags($this->note);
    }
}
