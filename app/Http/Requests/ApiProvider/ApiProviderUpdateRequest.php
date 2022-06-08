<?php

namespace App\Http\Requests\ApiProvider;

use App\Models\ApiProvider;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property int $id
 * @property string|null $name
 * @property string|null $url
 * @property string|null $key
 * @property string|null $type
 * @property float|null $balance
 * @property string|null $currency_code
 * @property string|null $description
 * @property bool|null $status
 */
class ApiProviderUpdateRequest extends FormRequest implements ApiProviderUpdateInterface
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

        return $user->hasPermissionTo(ApiProvider::MODEL_ROUTE_PERMISSION);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'            => 'required|exists:api_providers,id',
            'name'          => 'required|string',
            'url'           => 'required|string',
            'key'           => 'required|string',
            'type'          => 'required|string',
            'balance'       => 'required|numeric|min:1',
            'currency_code' => 'required|exists:currencies,description',
            'description'   => 'required|string',
            'status'        => 'required|boolean'
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return Auth::user()->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function getKey(): ?string
    {
        return $this->key;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getBalance(): ?float
    {
        return $this->balance;
    }

    public function getCurrencyCode(): ?string
    {
        return $this->currency_code;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }
}
