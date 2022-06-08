<?php

namespace App\Http\Requests\UserPrice;

use App\Models\User;
use App\Models\UserPrice;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property int $id
 * @property int $user_id
 * @property int $service_id
 * @property float $service_price
 */
class UserPriceUpdateRequest extends FormRequest implements UserPriceUpdateInterface
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

        return $user->hasPermissionTo(UserPrice::MODEL_ROUTE_PERMISSION);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "id"              => 'nullable|exists:user_prices,id',
            "user_id"         => 'nullable|exists:users,id',
            "service_id"      => 'nullable|exists:services,id',
            "service_price"   => 'required|numeric'
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getServiceId(): int
    {
        return $this->service_id;
    }

    public function getServicePrice(): float
    {
        return $this->service_price;
    }
}
