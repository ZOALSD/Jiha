<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Card;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\cardResource;
use App\Models\product;

class MyOrder extends Controller
{
    public function getMyOrder()
    {

        $card =   Card::where('user_id', auth('sanctum')->id())->
        with('order')->with('order.product')
        ->orderBy('id', 'desc')
        ->select('id','total','number_notification','image_notification')
        ->get();

        // return $card;
        foreach ($card as $data) {
            foreach ($data->order as $value) {
                $value->product = 
                product::where('id',$value->product_id)->first();
                // return $value;
            }

        }

       $data =  cardResource::collection($card);

        return response()->json($data, 200);
    }
}
