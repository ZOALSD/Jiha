<?php

namespace App\Http\Resources;

use App\Models\product;
use App\Models\Size;
use Illuminate\Http\Resources\Json\JsonResource;

class SizesResource extends JsonResource
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
            'size_id' => $this->size_id //Size::where('id',$this->size_id)->value('size'),
        ];
    }
}
