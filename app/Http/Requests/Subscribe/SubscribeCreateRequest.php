<?php

namespace App\Http\Requests\Subscribe;

use App\Models\Subscribe;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string $emailNewsletter
 */
class SubscribeCreateRequest extends FormRequest implements SubscribeCreateInterface
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

        return $user->hasPermissionTo(Subscribe::MODEL_ROUTE_PERMISSION);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "first_name"        => 'nullable|string',
            "last_name"         => 'nullable|string',
            "emailNewsletter"   => 'required|email',
        ];
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function getEmail(): string
    {
        return $this->emailNewsletter;
    }

    public function getIp(): ?string
    {
        return Request::ip();
    }

    public function getCountryCode(): string
    {
        return request()->server('HTTP_GEOIP_COUNTRY_CODE') ?? '';
    }
}
