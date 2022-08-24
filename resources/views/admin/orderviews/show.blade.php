@extends('admin.index')
@section('content')
<div class="card card-dark">
	<div class="card-header">
		<h3 class="card-title">
			Orders
		</h3>
		<div class="card-tools">
			<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
			<button type="button" class="btn btn-tool" data-card-widget="maximize"><i
					class="fas fa-expand"></i></button>
		</div>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
	<div class="row">
		.
	</div>
		<table class="table">
			<thead class="thead-inverse">
				<tr>
					<th>product</th>
					<th>color</th>
					<th>size</th>
					<th>quantity</th>
					<th>price</th>
					<th>total</th>
				</tr>
			</thead>

			@foreach ($orders as $order)
			<tbody>
				<tr>
					<td>{{$order->product->name}}</td>

					<td> {{App\Models\Color::where('code',$order->color)->value('name')}}</td>
					<td>{{$order->size}}</td>
					<td>{{$order->quantity}}</td>
					<td>{{$order->price}}</td>
					<td>{{$order->quantity * $order->price}}</td>
				</tr>
			</tbody>

			@endforeach

		</table>
	</div>
	<!-- /.card-body -->
	<div class="card-footer">
		Customer name : {{$customer->first_name ." ". $customer->last_name}} <br />
		Customer phone : {{$customer->phone}}<br/>
		notification nunmber : {{$card->number_notification}}
				<span class="float-right mr-3 text-bold text-lg">
					Total : {{$summation}}</span>

		<button class="btn btn-outline-success float-right mx-2"><a href="{{aurl('/orderviews/seen/'.$card->id)}}">Seen</a></button>
		<button class="btn btn-outline-primary float-right mx-2"><a href="{{aurl('/orderviews')}}">Back</a></button>
	</div>
</div>
@endsection