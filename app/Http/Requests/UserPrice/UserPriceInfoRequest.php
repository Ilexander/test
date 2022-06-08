<?php

namespace App\Http\Requests\UserPrice;

use App\Models\User;
use App\Models\UserPrice;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property int $id
 */
class UserPriceInfoRequest extends FormRequest implements UserPriceInfoInterface
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
            "id"  => 'nullable|exists:user_prices,id',
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }
}
