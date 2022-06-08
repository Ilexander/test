<?php

namespace App\Http\Requests\Transaction;

use App\Models\Transaction;
use App\Models\User;
use App\Rules\CheckPaymentAmount;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property int payment_id
 * @property int amount
 * @property int|null currency
 */
class TransactionCreateRequest extends FormRequest implements TransactionCreateInterface
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
    public function rules(): array
    {
        return [
            'payment_id'        => 'required|exists:payments,id',
            'amount'            => ['required', 'numeric', new CheckPaymentAmount($this->payment_id)],
            'return_to_shop'    => 'required|in:on',
            'currency'          => 'nullable|exists:currencies,id',
        ];
    }

    public function getPaymentId(): int
    {
        return $this->payment_id;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getUserId(): int
    {
        return Auth::user() ? Auth::user()->id : 0;
    }

    public function getCurrency(): ?int
    {
        return $this->currency;
    }

    public function setCurrency(int $currency): void
    {
        $this->currency = $currency;
    }
}
