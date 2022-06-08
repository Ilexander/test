<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property int|null $role_id
 * @property string|null $sort_field
 * @property string|null $sort_type
 * @property int|null $limit
 * @property string|null $api_key
 * @property string|null $email
 * @property string|null $first_last_name
 * @property string|null $search
 */
class UserAllRequest extends FormRequest implements UserAllInterface
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
    public function rules()
    {
        return [
            "role_id"       => "nullable|exists:roles,id",
            "api_key"       => "nullable|exists:users,api_key",
            "sort_field"    => "nullable|in:id,created_at,".implode(',',(new User())->getFillable()),
            "sort_type"     => "nullable|in:asc,desc",
            "limit"         => "nullable|numeric|min:1",
            "email"         => "nullable|string",
            "first_last_name" => "nullable|string",
            "search"        => "nullable|string"
        ];
    }

    /**
     * @return string|null
     */
    public function getSearchFilter(): ?string
    {
        return $this->search;
    }

    public function getEmailFilter(): ?string
    {
        return $this->email;
    }

    public function getFirstLastNameFilter(): ?string
    {
        return $this->first_last_name;
    }

    public function getRoleIdFilter(): ?int
    {
        return $this->role_id;
    }

    public function getSortField(): ?string
    {
        return $this->sort_field;
    }

    public function getSortType(): ?string
    {
        return $this->sort_type;
    }

    public function getLimit(): ?int
    {
        return $this->limit;
    }

    public function getApiKeyFilter(): ?string
    {
        return $this->api_key;
    }
}
