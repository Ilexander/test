<?php

namespace App\Http\Resources\Category;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;

class CategoryInfoResource extends JsonResource
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
        'description' => "mixed",
        'image_url' => "mixed",
        'sort' => "mixed",
        'status' => "mixed"
    ])]
    public function toArray($request): array | Arrayable | JsonSerializable
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'name' => $this->name,
            'description' => $this->description,
            'image_url' => $this->image_url,
            'sort' => $this->sort,
            'status' => $this->status
        ];
    }
}
