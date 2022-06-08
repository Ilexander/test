<?php

namespace App\Http\Requests\Service;

use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property int $id
 * @property int|null $category_id
 * @property string|null $name
 * @property string|null $desc
 * @property float|null $price
 * @property float|null $original_price
 * @property int|null $min
 * @property int|null $max
 * @property string|null $add_type
 * @property string|null $type
 * @property string|null $api_service_id
 * @property int|null $api_provider_id
 * @property boolean|null $dripfeed
 * @property boolean|null $status
 */
class ServiceUpdateRequest extends FormRequest implements ServiceUpdateInterface
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

        return $user->hasPermissionTo(Service::MODEL_ROUTE_PERMISSION);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'                => 'required|exists:services,id',
            'category_id'       => 'nullable|exists:categories,id',
            'name'              => 'nullable|string',
            'desc'              => 'nullable|string',
            'price'             => 'nullable|numeric',
            'original_price'    => 'nullable|numeric',
            'min'               => 'nullable|numeric',
            'max'               => 'nullable|numeric',
            'add_type'          => 'nullable|string',
            'type'              => 'nullable|string',
            'api_service_id'    => 'nullable|string',
            'api_provider_id'   => 'nullable|exists:api_providers,id',
//            'dripfeed'          => 'nullable|boolean',
            'status'            => 'nullable|boolean',
        ];
    }

    protected function prepareForValidation()
    {
        if (is_string($this->status)) {
            $this->merge([
                'status' => json_decode($this->status),
            ]);
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return Auth::user()->id;
    }

    public function getCategoryId(): ?int
    {
        return $this->category_id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getDesc(): ?string
    {
        return $this->desc;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function getOriginalPrice(): ?float
    {
        return $this->original_price;
    }

    public function getMin(): ?int
    {
        return $this->min;
    }

    public function getMax(): ?int
    {
        return $this->max;
    }

    public function getAddType(): ?string
    {
        return $this->add_type;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getApiServiceId(): ?string
    {
        return $this->api_service_id;
    }

    public function getApiProviderId(): ?int
    {
        return $this->api_provider_id;
    }

    public function getDripFeed(): ?bool
    {
        return $this->dripfeed;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }
}
