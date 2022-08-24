<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class cardResource extends JsonResource
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
            "orderId" => $this->id,
            "userId" => $this->user_id,
            "total" => $this->total,
            "number_notification" => $this->number_notification,
            "image_notification" => $this->image_notification,
            "status" => $this->status,
            "orders" => OrderResource::collection($this->order)
        ];
    }
}
