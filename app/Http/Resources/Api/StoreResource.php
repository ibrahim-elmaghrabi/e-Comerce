<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\Api\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
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
            'name' => $this->name,
            'image' => $this->image,
            'products_count' =>  $this->whenCounted('products'),
            'user' =>  BasicDataResource::make($this->whenLoaded('user')),
        ];
    }
}
