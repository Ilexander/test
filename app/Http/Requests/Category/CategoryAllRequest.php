<?php

namespace App\Http\Requests\Category;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CategoryAllRequest extends FormRequest implements CategoryAllInterface
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

        return $user->hasPermissionTo(Category::MODEL_ROUTE_PERMISSION);
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
