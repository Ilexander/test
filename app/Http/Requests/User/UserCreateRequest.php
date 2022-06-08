<?php

namespace App\Http\Requests\User;

use App\Models\User;
use App\Rules\Timezone;
use App\Services\TimeService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

/**
 * Class UserCreateRequest
 * @package App\Http\Requests\User
 *
 * @property string email
 * @property string first_name
 * @property string|null last_name
 * @property string password
 * @property string timezone
 * @property int $role_id
 * @property array|null $payments
 * @property array|null $services
 */
class UserCreateRequest extends FormRequest implements UserCreateInterface
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

        return $user->hasPermissionTo(User::MODEL_ROUTE_PERMISSION);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(TimeService $service)
    {
        return [
            "email"                 => "required|email|unique:users,email",
            "first_name"            => "required|string",
            "agree"                 => "required|string|in:on",
            "last_name"             => "nullable|string",
            "password"              => "required|string|confirmed",
            "timezone"              => ["required", new Timezone($service)],
            "role_id"               => "required|exists:roles,id",
            "payments"              => "nullable|array",
            "payments.*"            => "required|exists:payments,id",
            "services"              => "nullable|array",
            "services.*.service"    => "required|exists:services,id",
            "services.*.priceValue" => "required|numeric|min:1",
//            'g-recaptcha-response'  => 'recaptcha',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'role_id' => 2,
        ]);
    }

    public function getRoleId(): int
    {
        return $this->role_id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getTimezone(): string
    {
        return $this->timezone;
    }

    public function getPayments(): ?array
    {
        return $this->payments;
    }

    public function getServices(): ?array
    {
        return $this->services;
    }
}
