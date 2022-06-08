<?php

namespace App\Http\Requests\User;

use App\Models\User;
use App\Rules\Timezone;
use App\Services\TimeService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

/**
 * @property int $id
 * @property int|null $role_id
 * @property string|null $role_name
 * @property string|null $desc
 * @property int|null $status
 * @property string|null email
 * @property string|null first_name
 * @property string|null last_name
 * @property string|null timezone
 * @property string|null change_password
 * @property float|null balance
 * @property array|null $payments
 * @property array|null $services
 * @property array|null $more_information
 * @property UploadedFile|null $avatar
 */
class UserUpdateRequest extends FormRequest implements UserUpdateInterface
{
    private string $image_url = '';
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
     * @param TimeService $service
     * @return array
     */
    public function rules(TimeService $service): array
    {
        return [
            "id"                    => 'required|exists:users,id',
            "email"                 => "nullable|email|unique:users,email",
            "first_name"            => "nullable|string",
            "last_name"             => "nullable|string",
            "change_password"       => "nullable|string|confirmed",
            "balance"               => "nullable|numeric",
            "timezone"              => ["nullable", new Timezone($service)],
            "role_id"               => "nullable|exists:roles,id",
            "role_name"             => "nullable|exists:roles,name",
            "desc"                  => "nullable",
            "status"                => "nullable|in:".implode(',', array_keys(User::STATUS_LIST)),
            "payments"              => "nullable|array",
            "payments.*"            => "required|exists:payments,id",
            "services"              => "nullable|array",
            "services.*.service"    => "required|exists:services,id",
            "services.*.priceValue" => "required|numeric|min:1",
            "more_information"      => "nullable|array",
            "avatar"                => "nullable|image",
        ];
    }

    /**
     * @return string
     */
    public function getImageUrl(): string
    {
        return $this->image_url;
    }

    /**
     * @param string $image_url
     */
    public function setImageUrl(string $image_url): void
    {
        $this->image_url = $image_url;
    }

    /**
     * @return UploadedFile|null
     */
    public function getAvatar(): ?UploadedFile
    {
        return $this->avatar;
    }

    /**
     * @return array|null
     */
    public function getMoreInformation(): ?array
    {
        return $this->more_information;
    }

    /**
     * @return string|null
     */
    public function getRoleName(): ?string
    {
        return $this->role_name;
    }

    /**
     * @return string|null
     */
    public function getDesc(): ?string
    {
        return $this->desc;
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function getRoleId(): ?int
    {
        return $this->role_id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function getTimezone(): ?string
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

    public function getChangePassword(): ?string
    {
        return $this->change_password;
    }

    public function getBalance(): ?float
    {
        return $this->balance;
    }
}
