<?php

namespace App\Http\Requests\Language;

use App\Models\Language;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property int|null $id
 * @property int $user_id
 * @property array|null $ids
 * @property bool|null $status
 */
class LanguageDeleteRequest extends FormRequest implements LanguageDeleteInterface
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

        return $user->hasPermissionTo(Language::MODEL_ROUTE_PERMISSION);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required_without:ids|exists:languages,id',
            'ids' => 'required_without:id|array',
            'ids.*' => 'required|exists:languages,id',
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
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
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
}
