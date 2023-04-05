<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
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
            'type' => $this->type,
            'code' => $this->code,
            'value' => $this->value,
            'count' => $this->count,
            'status' => $this->status,
            'start_at' =>$this->start_at,
            'end_at' => $this->end_at,
            'store' => new StoreResource($this->whenLoaded('store')),
        ];
    }
}
