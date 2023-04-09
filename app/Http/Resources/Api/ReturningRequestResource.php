<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ReturningRequestResource extends JsonResource
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
            'reason' => $this->reason,
            'message' => $this->message,
            'product' =>  BasicDataResource::make($this->whenLoaded('product')),
            'user' =>  BasicDataResource::make($this->whenLoaded('user')),
        ];
    }
}
