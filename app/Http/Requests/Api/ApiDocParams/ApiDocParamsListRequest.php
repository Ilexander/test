<?php

namespace App\Http\Requests\Api\ApiDocParams;

use App\Models\ApiDocParams;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property int|null $api_doc_id
 */
class ApiDocParamsListRequest extends FormRequest implements ApiDocParamsListInterface
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

        return $user->hasPermissionTo(ApiDocParams::MODEL_ROUTE_PERMISSION);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "api_doc_id" => "nullable|exists:api_docs,id"
        ];
    }

    public function getApiDocId(): ?int
    {
        return $this->api_doc_id;
    }
}
