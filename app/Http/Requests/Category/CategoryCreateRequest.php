<?php

namespace App\Http\Requests\Category;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

/**
 * Class CategoryCreateRequest
 * @package App\Http\Requests\Category
 *
 * @property int user_id
 * @property string name
 * @property string description
 * @property UploadedFile|null image
 * @property int sort
 * @property bool status
 */
class CategoryCreateRequest extends FormRequest implements CategoryCreateInterface
{
    /**
     * @var mixed
     */
    private ?string $image_url = null;

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
            'user_id'       => 'required|exists:users,id',
            'name'          => 'required|string',
            'description'   => 'required|string',
            'image'         => 'nullable|image',
            'sort'          => 'nullable|numeric',
            'status'        => 'nullable|boolean',
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

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getImage(): ?UploadedFile
    {
        return $this->image;
    }

    public function getSort(): int
    {
        return $this->sort;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function getImageUrl(): ?string
    {
        return $this->image_url;
    }

    public function setImageUrl(string $image_url): void
    {
        $this->image_url = $image_url;
    }
}
