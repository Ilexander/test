<?php

namespace App\Http\Requests\Service;

use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property int $api_provider_id
 */
class ApiServiceRequest extends FormRequest
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

        return $user->hasPermissionTo(Service::MODEL_ROUTE_PERMISSION);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'api_provider_id' => 'required|exists:api_providers,id',
        ];
    }

    /**
     * @return int
     */
    public function getApiProviderId(): int
    {
        return $this->api_provider_id;
    }
}
