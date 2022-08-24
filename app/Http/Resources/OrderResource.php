<?php

namespace App\Http\Resources;

use App\Models\product;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            // "id" => $this->id,
            // "OrderId" => $this->card_id,
            // "product_id" => product::where('id',$this->product_id)->all(),
            "quantity" => $this->quantity,
            "price" => $this->price,
            "color" => $this->color,
            "size" => $this->size,
            "summation" => $this->summation,
            'product' => $this->product,
        ];
    }
}
