<?php

namespace App\Http\Requests\Category;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Class CategoryDeleteRequest
 * @package App\Http\Requests\Category
 *
 * @property int|null id
 * @property int user_id
 * @property array|null $ids
 * @property bool|null $status
 */
class CategoryDeleteRequest extends FormRequest implements CategoryDeleteInterface
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

        return $user->hasPermissionTo(Category::MODEL_ROUTE_PERMISSION);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id'  => 'required|exists:users,id',
            'id' => 'required_without:ids|exists:categories,id',
            'ids' => 'required_without:id|array',
            'ids.*' => 'required|exists:categories,id',
            'status' => 'nullable|boolean'
        ];
    }

    protected function prepareForValidation()
    {
        if (is_string($this->status)) {
            $this->merge([
                'status' => json_decode($this->status),
            ]);
        }

        $this->merge([
            'user_id' => Auth::user()->id,
        ]);
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return array|null
     */
    public function getIds(): ?array
    {
        return $this->ids;
    }

    /**
     * @return bool|null
     */
    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }
}
