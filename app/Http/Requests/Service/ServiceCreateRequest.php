<?php

namespace App\Http\Requests\Service;

use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property int $category_id
 * @property string $name
 * @property string $desc
 * @property float $price
 * @property float $original_price
 * @property int $min
 * @property int $max
 * @property string $add_type
 * @property string $type
 * @property string $api_service_id
 * @property int $api_provider_id
 * @property boolean $dripfeed
 * @property boolean $status
 */
class ServiceCreateRequest extends FormRequest implements ServiceCreateInterface
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
            'category_id'       => 'required|exists:categories,id',
            'name'              => 'required|string',
            'desc'              => 'required|string',
            'price'             => 'required|numeric',
            'original_price'    => 'required|numeric',
            'min'               => 'required|numeric|min:1',
            'max'               => 'required|numeric|min:1',
            'add_type'          => 'required|string',
            'type'              => 'required|string',
            'api_service_id'    => 'required|string',
            'api_provider_id'   => 'required|exists:api_providers,id',
//            'dripfeed'          => 'required|boolean',
            'status'            => 'required|boolean',
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

    public function getUserId(): int
    {
        return Auth::user()->id;
    }

    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDesc(): string
    {
        return $this->desc;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getOriginalPrice(): float
    {
        return $this->original_price;
    }

    public function getMin(): int
    {
        return $this->min;
    }

    public function getMax(): int
    {
        return $this->max;
    }

    public function getAddType(): string
    {
        return $this->add_type;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getApiServiceId(): string
    {
        return $this->api_service_id;
    }

    public function getApiProviderId(): int
    {
        return $this->api_provider_id;
    }

    public function getDripFeed(): bool
    {
        return false;
        return $this->dripfeed;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }
}
