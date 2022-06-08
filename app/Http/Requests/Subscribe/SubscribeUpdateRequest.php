<?php

namespace App\Http\Requests\Subscribe;

use App\Models\Subscribe;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string|null $ip
 * @property string|null $country_code
 */
class SubscribeUpdateRequest extends FormRequest implements SubscribeUpdateInterface
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
            'id'            => 'required|exists:subscribes,id',
            "first_name"    => 'required|string',
            "last_name"     => 'required|string',
            "email"         => 'required|email',
            "ip"            => 'required|string',
            "country_code"  => 'nullable|string',
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function getCountryCode(): string
    {
        return $this->country_code ?? '';
    }
}
