<?php

namespace App\Http\Requests\Translation;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property string entity_type
 */
class RemoveTranslationByEntityRequest extends FormRequest implements RemoveTranslationByEntityInterface
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
    #[ArrayShape(['entity_type' => "string[]"])]
    public function rules(): array
    {
        return [
            'entity_type' => ['required', 'string']
        ];
    }

    /**
     * @return string
     */
    public function getEntityType(): string
    {
        return $this->entity_type;
    }
}
