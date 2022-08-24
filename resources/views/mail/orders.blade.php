@component('mail::message')

order number : {{$data['data']->id}}<br>
form : <h3>{{$data['name']}}</h3> <br />
@component('mail::table')
|product|color|size|price|quantity|
| ------|-----|----|-----|--------|
@foreach ($data['data']->order as $order )
|{{ $order->product_id }}|{{$order->color}}|{{$order->size}}|{{$order->price}}|{{$order->quantity}}|
@endforeach
@endcomponent

Payment Notice Picture :

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

customer email : <h2>{{$data['email']}}</h2> &nbsp; &nbsp; customer phone number : <h2>{{$data['phone']}}</h2>

total orders : {{$data['data']->total}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent

{{-- <img src="{{$message->embed(asset('storage/'.$data['data']->image_notification))}}"> --}}
