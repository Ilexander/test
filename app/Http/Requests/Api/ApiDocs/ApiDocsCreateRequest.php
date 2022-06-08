<?php

namespace App\Http\Requests\Api\ApiDocs;

use App\Models\ApiDoc;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property string $title
 * @property string|null $description
 * @property string|null $response
 * @property array|null $requestParams
 */
class ApiDocsCreateRequest extends FormRequest implements ApiDocsCreateInterface
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
    public function rules(): array
    {
        return [
            'title'                         => 'required|string',
            'description'                   => 'nullable|string',
            'response'                      => 'nullable|string',
            'requestParams'                 => 'nullable|array',
            'requestParams.*.parameter'     => 'required',
            'requestParams.*.description'   => 'required',
        ];
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getResponse(): ?string
    {
        return $this->response;
    }

    public function getRequestParams(): ?array
    {
        return $this->requestParams;
    }
}
