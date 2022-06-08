<?php

namespace App\Http\Requests\Payment;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

/**
 * @property string name
 * @property UploadedFile|null image
 * @property string type
 * @property integer min
 * @property integer max
 * @property boolean status
 * @property boolean take_fee_from_user
 * @property string client_id
 * @property string secret_key
 * @property integer limit
 * @property array|null currency
 */
class PaymentCreateRequest extends FormRequest implements PaymentCreateInterface
{
    /**
     * @var mixed|string
     */
    private ?string $image_url = null;

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

        return $user->hasPermissionTo(Payment::MODEL_ROUTE_PERMISSION);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'                  => 'required|string',
            'image'                 => 'required|image',
            'type'                  => 'required|string',
            'min'                   => 'required|numeric',
            'max'                   => 'required|numeric',
            'status'                => 'required|boolean',
            'take_fee_from_user'    => 'required|boolean',
            'client_id'             => 'required|string',
            'secret_key'            => 'required|string',
            'limit'                 => 'required|numeric',
            'currency'              => 'nullable|array',
            'currency.*'            => 'required|exists:currencies,id'
        ];
    }

    protected function prepareForValidation()
    {
        if (is_string($this->status)) {
            $this->merge([
                'status' => json_decode($this->status),
            ]);
        }

        if (is_string($this->take_fee_from_user)) {
            $this->merge([
                'take_fee_from_user' => json_decode($this->take_fee_from_user),
            ]);
        }

        if (is_string($this->users_allowed)) {
            $this->merge([
                'users_allowed' => json_decode($this->users_allowed),
            ]);
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getImage(): ?UploadedFile
    {
        return $this->image;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getMin(): int
    {
        return $this->min;
    }

    public function getMax(): int
    {
        return $this->max;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function getTakeFeeFromUser(): bool
    {
        return $this->take_fee_from_user;
    }

    public function getClientId(): string
    {
        return $this->client_id;
    }

    public function getSecretKey(): string
    {
        return $this->secret_key;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function setImageUrl(string $imageUrl): void
    {
        $this->image_url = $imageUrl;
    }

    public function getImageUrl(): ?string
    {
        return $this->image_url;
    }

    public function getCurrency(): ?array
    {
        return $this->currency;
    }
}
