<?php

namespace App\Http\Resources\Service;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'category_id' => $this->category_id,
            'name' => $this->name,
            'desc' => $this->desc,
            'price' => $this->price,
            'min' => $this->min,
            'max' => $this->max,
            'add_type' => $this->add_type,
            'type' => $this->type,
            'dripfeed' => $this->dripfeed,
            'status' => $this->status,
            'api_provider_id' => $this->api_provider_id
        ];
    }
}
