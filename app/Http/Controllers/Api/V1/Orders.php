<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Card;
use App\Models\User;
use App\Models\Color;
use App\Models\Order;
use App\Mail\NewOrders;
use App\Models\General;
use App\Models\product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\cardResource;
use Illuminate\Support\Facades\Mail;

class Orders extends Controller
{

    public function cardTake(Request $data)
    {

        $card_id = Card::where('user_id', auth('sanctum')->id())->where('status', false)->value('id');

        if (!$card_id) {
            $card = Card::create(['user_id' => auth('sanctum')->id()]);
            $card_id = $card->id;
        }

        if ($card_id) {

            if (!$data['product_id'])
                return response()->json(['Product is Required' => null], 200,);

            if (!$data['price'])
                return response()->json(['price is Required' => null], 200,);

            if (!$data['quantity'])
                return response()->json(['quantity is Required' => null], 200,);

            if (!$data['color'])
                return response()->json(['Color is Required' => null], 200,);

            if (!$data['size'])
                return response()->json(['size is Required' => null], 200,);

            Order::create([
                "card_id" => $card_id,
                "product_id" => $data["product_id"],
                'price' => $data["price"],
                'quantity' => $data['quantity'],
                'color' => $data['color'],
                'size' => $data['size'],
                'summation' => $data['quantity'] * $data['price']
            ]);
            Card::where('id', $card_id)->update(['total' => Order::where('card_id', $card_id)->sum('summation')]);

            $card = cardResource::collection(Card::where('id', $card_id)->with('order')->get());

            return response()->json($card, 200);
        }
    }

    public function card(Request $req)
    {

        $card_id = Card::where(['user_id' => auth('sanctum')->id(), 'status' => "0"])->orderBy('id', 'desc')->value('id');
        if (!$card_id) {
            $card =  Card::create(['user_id' => auth('sanctum')->id()]);
            $card_id = $card->id;
        }

        foreach ($req->all() as $data) {
            Order::create([
                "card_id" => $card_id,
                "product_id" => $data["product_id"],
                'price' => $data["price"],
                'quantity' => $data['quantity'],
                'color' => $data['color'],
                'size' => $data['size'],
                'summation' => $data['quantity'] * $data['price']
            ]);
        }

        Card::where('id', $card_id)->update(['total' => Order::where('card_id', $card_id)->sum('summation')]);
        $count = Order::where('card_id', $card_id)->select('product_id', 'price', 'quantity', 'color', 'size', 'summation')->count();
        $orders = Order::where('card_id', $card_id)->select('product_id', 'price', 'quantity', 'color', 'size', 'summation')->get();
        $deliveyPrice = General::where('id',1)->value('price');

        return response()->json(["Oder_Id" => $card_id, 'Delivery_Price' => $deliveyPrice , 'count' => $count, 'orders' => $orders], 200);
    }



    public function confirmOrder(Request $req)
    {

        $check = Card::where(['id' => $req->order_id, 'status' => '0'])->count();

        if ($check == 0) {
            return response()->json(['message' => 'You are Already Comfiram Order', 'status' => null], 201,);
        }

        $image = "";

        if (request()->hasFile("image")) {
            $image = it()->upload("image", "pay/" . $req->order_id);
        }

        $card =  Card::where('id', $req->order_id)->update([
            "image_notification" => $image,
            "number_notification" => $req->number_notification,
            "delivery" => $req->delivery,
            "status" => true
        ]);

        $card =   Card::where('id', $req->order_id)->with('order')->get();
        $data =  cardResource::collection($card);

        $user = User::where('id', auth('sanctum')->id())->first();

        return response()->json([
            'message' => 'Successfully Comfiram Order',
            'data' => $data,
            'status' => true
        ], 200);
    }
    public function mail()
    {


        $user = User::where('id',3)->first();

        $data =   Card::where('id',4)->with('order')->get();
        foreach($data as $d){
            $data = $d ;
        }

        foreach($data->order as $order){
            $order->product_id = product::where('id',$order->product_id)->value('name');
            $order->color = Color::where('code',$order->color)->value('name');
        }

        // foreach($data->order as $order){}
        
        Mail::to('Ahmed_moha2med@yahoo.com')->send(new NewOrders([
            'data' => $data, 
            'name' => $user->first_name ." ".$user->last_name,
            'email' => $user->email,
            'phone' => $user->phone,
        ]));
        
        return $data;
      
    }
}



/*
 
*/