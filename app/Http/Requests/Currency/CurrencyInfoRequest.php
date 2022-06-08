<?php

namespace App\Http\Requests\Currency;

use App\Models\Currency;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property int id
 */
class CurrencyInfoRequest extends FormRequest implements CurrencyInfoInterface
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

        return $user->hasPermissionTo(Currency::MODEL_ROUTE_PERMISSION);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "id" => 'required|exists:currencies,id'
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }
}
