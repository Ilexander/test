<?php

namespace App\Http\Requests\Role;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property int id
 * @property string name
 * @property array|null permission
 */
class RoleUpdateRequest extends FormRequest implements RoleUpdateInterface
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

        return $user->hasRole(User::ROLE_ADMIN);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'            => 'required|exists:roles,id',
            'name'          => 'required|string',
            'permission'    => 'nullable|array',
            'permission.*'  => 'required|exists:permissions,id',
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPermission(): ?array
    {
        return $this->permission;
    }
}
