<?php

namespace App\Http\Requests\PaymentBonus;

use App\Models\PaymentBonus;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property int $id
 * @property int $payment_id
 * @property int $bonus_start_funds
 * @property int $percentage
 * @property bool $status
 */
class PaymentBonusUpdateRequest extends FormRequest implements PaymentBonusUpdateInterface
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

        return $user->hasPermissionTo(PaymentBonus::MODEL_ROUTE_PERMISSION);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "id"                    => "required|exists:payment_bonuses,id",
            "payment_id"            => 'required|exists:payments,id',
            "bonus_start_funds"     => 'required|numeric|min:1',
            "percentage"            => 'required|numeric|min:1|max:100',
            "status"                => 'required|boolean',
        ];
    }

    protected function prepareForValidation()
    {
        if (is_string($this->status)) {
            $this->merge([
                'status' => json_decode($this->status),
            ]);
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPaymentId(): int
    {
        return $this->payment_id;
    }

    public function getBonusStartFunds(): int
    {
        return $this->bonus_start_funds;
    }

    public function getPercentage(): int
    {
        return $this->percentage;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }
}
