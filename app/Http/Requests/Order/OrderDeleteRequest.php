<?php

namespace App\Http\Requests\Order;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property int $id
 */
class OrderDeleteRequest extends FormRequest implements OrderDeleteInterface
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

        return $user->hasPermissionTo(Order::MODEL_ROUTE_PERMISSION);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:orders,id'
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return Auth::user()->id;
    }
}
