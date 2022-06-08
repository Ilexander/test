<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class MessageResource extends JsonResource
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
            'id'            => $this->id,
            'first_name'    => $this->user->first_name,
            'last_name'     => $this->user->last_name,
            'email'         => $this->user->email,
            'user_avatar'   => $this->user->image_file,
            'is_admin'      => $this->user->isAdmin(),
            'message'       => $this->message,
            'created_at'    => $this->created_at->format('Y-m-d H:i:s'),
            'can_delete'    => ($this->user->id == Auth::user()->id)
        ];
    }
}
