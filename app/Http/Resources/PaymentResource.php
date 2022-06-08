<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PaymentResource extends JsonResource
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
            'name'                  => $this->name,
            'image_url'             => Storage::disk('public')->get( $this->image_url),
            'type'                  => $this->type,
            'min'                   => $this->min,
            'max'                   => $this->max,
            'status'                => $this->status,
            'take_fee_from_user'    => $this->take_fee_from_user,
            'client_id'             => $this->client_id,
            'secret_key'            => $this->secret_key,
            'limit'                 => $this->limit,
        ];
    }
}
