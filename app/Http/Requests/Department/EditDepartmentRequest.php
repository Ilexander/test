<?php

namespace App\Http\Requests\Department;

use App\Models\Department;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Class EditDepartmentRequest
 * @property int id
 * @property string name
 * @property array members
 * @package App\Http\Requests\Department
 */
class EditDepartmentRequest extends FormRequest implements EditDepartmentInterface
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
            'id' => 'required|exists:departments,id',
            'name' => 'required|string',
            'members' => 'nullable|array',
            'members.*' => 'required|exists:users,id',
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

    public function getMembers(): ?array
    {
        return $this->members;
    }
}
