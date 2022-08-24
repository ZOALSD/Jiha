<?php

namespace App\Jobs;

use App\Models\Card;
use App\Models\User;
use App\Models\Color;
use App\Mail\NewOrders;
use App\Models\product;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class OrderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
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
    }
}
