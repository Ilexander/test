<?php

namespace App\Http\Requests\Api\ApiDocParams;

use App\Models\ApiDocParams;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property int|null $id
 * @property int|null $api_doc_id
 */
class ApiDocParamsDeleteRequest extends FormRequest implements ApiDocParamsDeleteInterface
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
    public function rules()
    {
        return [
            "id" => "nullable|exists:api_doc_params,id",
            "api_doc_id" => "nullable|exists:api_docs,id"
        ];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getApiDocId(): ?int
    {
        return $this->api_doc_id;
    }
}
