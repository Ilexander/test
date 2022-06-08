<?php

namespace App\Http\Requests\Api\ApiDocs;

use App\Models\ApiDoc;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property int $id
 */
class ApiDocsInfoRequest extends FormRequest implements ApiDocsInfoInterface
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

        return $user->hasPermissionTo(ApiDoc::MODEL_ROUTE_PERMISSION);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "id" => "required|exists:api_docs,id"
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }
}
