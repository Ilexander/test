<?php

namespace App\Http\Requests\Order;

use App\Models\Order;
use App\Models\User;
use App\Rules\CheckMassOrder;
use App\Rules\OrderQuantity;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use JetBrains\PhpStorm\ArrayShape;

/**
 *
 * @property int|null $category_id
 * @property int|null $service_id
 * @property string|null $link
 * @property string|null $quantity
 * @property string|null $order_type
 * @property string|null $mass_order
 */
class OrderCreateRequest extends FormRequest implements OrderCreateInterface
{
    private ?int $user_id = null;

    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);

        $this->user_id = Auth::user()->id ?? null;
    }

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

        return $user->hasPermissionTo(Order::MODEL_ROUTE_PERMISSION);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape([
        "order_type" => "string",
        "category_id" => "string",
        "service_id" => "string",
        "link" => "string",
        "quantity" => "array",
        "confirmed-check" => "string",
        "mass_order" => "array"
    ])]
    public function rules(): array
    {
        $rules = [
            "order_type"            => 'required|in:mass,single',
            "category_id"           => 'required_if:order_type,single|exists:categories,id',
            "service_id"            => 'required_if:order_type,single|exists:services,id',
            "link"                  => 'required_if:order_type,single',
            "confirmed-check"       => 'required|in:on',
            "mass_order"            => ['required_if:order_type,mass', new CheckMassOrder()],
        ];

        if ($this->order_type === 'single') {
            $rules["quantity" ] = ['required_if:order_type,single','numeric', new OrderQuantity($this->service_id)];
        }

        return $rules;
    }

    public function prepareForValidation()
    {
        $this->merge([
            'link' => $this->orderFormLinkFollowers ?? $this->orderFormLinkLikes,
            'quantity' => $this->orderFormQuantity
        ]);
    }

    /**
     * @return string|null
     */
    public function getOrderType(): ?string
    {
        return $this->order_type;
    }

    /**
     * @return string|null
     */
    public function getMassOrder(): ?string
    {
        return $this->mass_order;
    }

    public function getCategoryId(): ?int
    {
        return $this->category_id;
    }

    public function getServiceId(): ?int
    {
        return $this->service_id;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function getQuantity(): ?string
    {
        return $this->quantity;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(?int $user_id)
    {
        $this->user_id = $user_id;
    }
}
