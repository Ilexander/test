<?php

namespace App\Http\Requests\Setting;

use App\Models\Settings;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int $id
 * @property string $page_name
 * @property string $field_name
 * @property string $field_value
 */
class SettingUpdateRequest extends FormRequest implements SettingUpdateInterface
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
    public function rules()
    {
        return [
            'id' => ["required", "exists:settings,id"],
            'page_name' => ["required", "in:".implode(',', Settings::SETTING_PAGE_ARRAY)],
            'field_name' => ["required"],
            'field_value' => ["required"],
        ];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
     * @return string
     */
    public function getFieldValue(): string
    {
        return $this->field_value;
    }
}
