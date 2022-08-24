<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class productsResource extends JsonResource
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
            'price' => $this->price,
            'image' => $this->image,
            'colors' => $this->color,
            'sizes' => $this->sizes,
            'available' => $this->available,
            'desc_en' => $this->desc_en,
            'desc_ar' => $this->desc_ar,
            'desc_en' => $this->desc_en
        ];
    }
}
