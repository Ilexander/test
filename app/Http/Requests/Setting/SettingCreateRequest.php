<?php

namespace App\Http\Requests\Setting;

use App\DTO\Setting\SettingItemDTO;
use App\Http\Requests\Language\LanguageAllRequest;
use App\Models\Settings;
use App\Services\Language\LanguageFacade;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string page_name
 * @property string field_name
 * @property mixed field_value
 * @property string|null language_name
 * @property int|null language_id
 */
class SettingCreateRequest extends FormRequest implements SettingCreateInterface
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'page_name' => ["required", "in:".implode(',', Settings::SETTING_PAGE_ARRAY)],
            'field_name' => ["required"],
            'field_value' => ["required"],
            'language_name' => ["nullable"],
            'language_id' => ["nullable", "exists:languages,id"],
        ];
    }

    /**
     * @return string
     */
    public function getPageName(): string
    {
        return $this->page_name;
    }

    /**
     * @return string
     */
    public function getFieldName(): string
    {
        return $this->field_name;
    }

    /**
     * @return mixed
     */
    public function getFieldValue(): mixed
    {
        return $this->field_value;
    }

    /**
     * @return string|null
     */
    public function getLanguageName(): ?string
    {
        return $this->language_name;
    }

    /**
     * @return int|null
     */
    public function getLanguageId(): ?int
    {
        return $this->language_id;
    }
}
