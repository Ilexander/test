<?php

namespace App\Http\Requests\Department;

use App\Models\Department;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Class AddDepartmentRequest
 * @package App\Http\Requests\Department
 *
 * @property string name
 * @property array|null members
 */
class AddDepartmentRequest extends FormRequest implements AddDepartmentInterface
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

        return $user->hasPermissionTo(Department::MODEL_ROUTE_PERMISSION);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'members' => 'nullable|array',
            'members.*' => 'required|exists:users,id',
        ];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getMembers(): ?array
    {
        return $this->members;
    }
}
