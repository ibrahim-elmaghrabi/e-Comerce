<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\Api\SizeResource;
use App\Http\Resources\Api\StoreResource;
use App\Http\Resources\Api\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'description' =>$this->description,
            'tax_number' => $this->tax_number,
            'category' => BasicDataResource::make($this->whenLoaded('category')),
            'store' =>   BasicDataResource::make($this->whenLoaded('store')),
            'sizes' =>   BasicDataResource::make($this->whenLoaded('sizes')),
            'images' =>   BasicDataResource::make($this->whenLoaded('images')),
        ];
    }
}
