<?php

namespace App\Http\Requests\ApiProvider;

use App\Models\ApiProvider;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property int $id
 */
class ApiProviderInfoRequest extends FormRequest implements ApiProviderInfoInterface
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

        return $user->hasPermissionTo(ApiProvider::MODEL_ROUTE_PERMISSION);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'id'  => 'required|exists:api_providers,id',
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }
}
