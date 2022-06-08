<?php

namespace App\Http\Resources\ApiProvider;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;

class ApiProviderInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    #[ArrayShape([
        'id' => "mixed",
        'user_id' => "mixed",
        'name' => "mixed",
        'url' => "mixed",
        'type' => "mixed",
        'balance' => "mixed",
        'currency_code' => "mixed",
        'description' => "mixed",
        'status' => "mixed"
    ])]
    public function toArray($request): array | Arrayable | JsonSerializable
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'name' => $this->name,
//            'url' => $this->url,
            'type' => $this->type,
//            'balance' => $this->balance,
            'currency_code' => $this->currency_code,
            'description' => $this->description,
            'status' => $this->status,
        ];
    }
}
