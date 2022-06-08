<?php

namespace App\Http\Requests\ApiProvider;

use App\Models\ApiProvider;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property string $name
 * @property string $url
 * @property string $key
 * @property string $type
 * @property float $balance
 * @property string $currency_code
 * @property string $description
 * @property bool $status
 */
class ApiProviderCreateRequest extends FormRequest implements ApiProviderCreateInterface
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

    public function getUserId(): int
    {
        return Auth::user()->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }

    public function getCurrencyCode(): string
    {
        return $this->currency_code;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }
}
