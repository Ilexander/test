<?php

namespace App\Http\Requests\Setting;

use App\Models\Settings;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $page_name
 * @property string|null $field_name
 * @property string|null $field_value
 */
class SettingAllRequest extends FormRequest implements SettingAllInterface
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
            'field_name' => ["nullable"],
            'field_value' => ["nullable"],
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
     * @return string|null
     */
    public function getFieldName(): ?string
    {
        return $this->field_name;
    }

    /**
     * @return string|null
     */
    public function getFieldValue(): ?string
    {
        return $this->field_value;
    }
}
