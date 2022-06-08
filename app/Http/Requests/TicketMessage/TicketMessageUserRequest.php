<?php

namespace App\Http\Requests\TicketMessage;

use App\Models\TicketMessage;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TicketMessageUserRequest extends FormRequest implements TicketMessageUserInterface
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

        return $user->hasPermissionTo(TicketMessage::MODEL_ROUTE_PERMISSION);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    public function getUserId(): int
    {
        return Auth::user() ? Auth::user()->id : 0;
    }
}
