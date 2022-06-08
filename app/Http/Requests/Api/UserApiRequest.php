<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $action
 * @property string $key
 * @property null|array $orders
 * @property null|int $order
 * @property null|int $service
 * @property null|string $link
 * @property null|int $quantity
 * @property null|int $runs
 * @property null|int $interval
 */
class UserApiRequest extends FormRequest implements UserApiInterface
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'key' => 'required|exists:users,api_key',
            'action' => 'required|in:add,status,services,balance',
            'order'  => 'nullable|numeric|min:1',
            'orders' => 'nullable|array',
            'orders.*' => 'required|numeric|min:1',
            'service'  => 'required_if:action,add|exists:services,id',
            'link'     => 'required_if:action,add|url',
            'quantity' => 'required_if:action,add|numeric|min:1',
            'runs'     => 'nullable|numeric|min:1',
            'interval' => 'nullable|numeric|min:1',
        ];
    }

    public function getService(): ?int
    {
        return $this->service;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function getRuns(): ?int
    {
        return $this->runs;
    }

    public function getInterval(): ?int
    {
        return $this->interval;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getOrders(): ?array
    {
        return $this->orders;
    }

    public function getOrder(): ?int
    {
        return $this->order;
    }
}
