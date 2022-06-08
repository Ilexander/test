<?php

namespace App\Http\Requests\UserPrice;

use App\Models\User;
use App\Models\UserPrice;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property int $user_id
 * @property int|null $service_id
 * @property float|null $service_price
 * @property array|null $services
 * @property array|null $service_prices
 */
class UserPriceCreateRequest extends FormRequest implements UserPriceCreateInterface
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
            "user_id"         => 'nullable|exists:users,id',
            "service_id"      => 'required_without:service_prices,services|exists:services,id',
            "service_price"   => 'required_without:service_prices,services|numeric',

            "services"  => 'required_without:service_price,service_id|array',
            "services.*"  => 'required|exists:services,id',
            "service_prices"  => 'required_without:service_price,service_id|array',
            "service_prices.*"  => 'required|numeric',
        ];
    }

    public function getServices(): ?array
    {
        return $this->services;
    }

    public function getServicePrices(): ?array
    {
        return $this->service_prices;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getServiceId(): ?int
    {
        return $this->service_id;
    }

    public function getServicePrice(): ?float
    {
        return $this->service_price;
    }
}
