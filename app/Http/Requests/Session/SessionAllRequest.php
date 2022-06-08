<?php

namespace App\Http\Requests\Session;

use App\Models\Session;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SessionAllRequest extends FormRequest implements SessionAllInterface
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

        return $user->hasPermissionTo(Session::MODEL_ROUTE_PERMISSION);
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
}
