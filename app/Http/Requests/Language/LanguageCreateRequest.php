<?php

namespace App\Http\Requests\Language;

use App\Models\Language;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

/**
 * @property string $name
 * @property string $alt
 * @property string $view
 * @property array|null $supported_countries
 * @property bool $status
 * @property UploadedFile $image
 */
class LanguageCreateRequest extends FormRequest implements LanguageCreateInterface
{
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
            'name'                  => 'required|string',
            'alt'                   => 'required|string',
            'supported_countries'   => 'required|array',
            'status'                => 'required|boolean',
            'image'                 => 'required|image',
            'view'                  => 'required|string|in:ltr,rtl'
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
     * @return string
     */
    public function getView(): string
    {
        return $this->view;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAlt(): string
    {
        return $this->alt;
    }

    public function getSupportedCountries(): array
    {
        return $this->supported_countries;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function getImage(): UploadedFile
    {
        return $this->image;
    }

    public function setImageUrl(string $image_url): void
    {
        $this->image_url = $image_url;
    }

    public function getImageUrl(): string
    {
        return $this->image_url ?? '';
    }
}
