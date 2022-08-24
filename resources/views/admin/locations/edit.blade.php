@extends('admin.index')
@section('content')


<div class="card card-dark">
	<div class="card-header">
		<h3 class="card-title">
			<div class="">
				<span>{{!empty($title)?$title:''}}</span>
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<span class="caret"></span>
					<span class="sr-only"></span>
				</a>
				<div class="dropdown-menu" role="menu">
					<a href="{{aurl('locations')}}" class="dropdown-item" style="color:#343a40">
						<i class="fas fa-list"></i> {{trans('admin.show_all')}} </a>
					<a href="{{aurl('locations/'.$locations->id)}}" class="dropdown-item" style="color:#343a40">
						<i class="fa fa-eye"></i> {{trans('admin.show')}} </a>
					<a class="dropdown-item" style="color:#343a40" href="{{aurl('locations/create')}}">
						<i class="fa fa-plus"></i> {{trans('admin.create')}}
					</a>
					<div class="dropdown-divider"></div>
					<a data-toggle="modal" data-target="#deleteRecord{{$locations->id}}" class="dropdown-item"
						style="color:#343a40" href="#">
						<i class="fa fa-trash"></i> {{trans('admin.delete')}}
					</a>
				</div>
			</div>
		</h3>
		@push('js')
		<div class="modal fade" id="deleteRecord{{$locations->id}}">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">{{trans('admin.delete')}}</h4>
						<button class="close" data-dismiss="modal">x</button>
					</div>
					<div class="modal-body">
						<i class="fa fa-exclamation-triangle"></i> {{trans('admin.ask_del')}} {{trans('admin.id')}}
						({{$locations->id}})
					</div>
					<div class="modal-footer">
						{!! Form::open([
						'method' => 'DELETE',
						'route' => ['locations.destroy', $locations->id]
						]) !!}
						{!! Form::submit(trans('admin.approval'), ['class' => 'btn btn-danger btn-flat']) !!}
						<a class="btn btn-default btn-flat" data-dismiss="modal">{{trans('admin.cancel')}}</a>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
		@endpush
		<div class="card-tools">
			<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
			<button type="button" class="btn btn-tool" data-card-widget="maximize"><i
					class="fas fa-expand"></i></button>
		</div>
	</div>
	<!-- /.card-header -->
	<div class="card-body">

		{!!
		Form::open(['url'=>aurl('/locations/'.$locations->id),'method'=>'put','id'=>'locations','files'=>true,'class'=>'form-horizontal
		form-row-seperated']) !!}
		<div class="row">

			<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
				<div class="form-group">
					{!! Form::label('days_wrok',trans('admin.days_wrok'),['class'=>'control-label']) !!}

					{{$locations->days_wrok}}
					<div class="form-group">
						<label>Multiple</label>
						<select name="days_wrok[]" class="select2" multiple="multiple" data-placeholder="Select a State"
							style="width: 100%;">
							<option selected>Saturday</option>
							<option selected>Sunday</option>
							<option selected>Monday</option>
							<option selected>Tuesday</option>
							<option selected>Wednesday</option>
							<option selected>Thursday</option>
							<option>Friday</option>
						</select>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
				<div class="form-group">
					{!! Form::label('location',trans('admin.location'),['class'=>'control-label']) !!}
					{!! Form::text('location', $locations->location
					,['class'=>'form-control','placeholder'=>trans('admin.location')]) !!}
				</div>
			</div>

			<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
				<div class="form-group">
					{!! Form::label('phone',trans('admin.phone'),['class'=>'control-label']) !!}
					{!! Form::text('phone', $locations->phone
					,['class'=>'form-control','placeholder'=>trans('admin.phone')]) !!}
				</div>
			</div>

			<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
				<div class="form-group">
					{!! Form::label('lat',trans('admin.lat'),['class'=>'control-label']) !!}
					{!! Form::text('lat', $locations->lat ,['class'=>'form-control','placeholder'=>trans('admin.lat')])
					!!}
				</div>
			</div>
			<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
				<div class="form-group">
					{!! Form::label('lng',trans('admin.lng'),['class'=>'control-label']) !!}
					{!! Form::text('lng', $locations->lng ,['class'=>'form-control','placeholder'=>trans('admin.lng')])
					!!}
				</div>
			</div>

			<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
				<div class="form-group">
				  {!! Form::label('hour_start',trans('admin.hour_start')) !!}
				  <input type="time" name="hour_start" value={{$locations->hour_start}} class="form-control">
				  <!-- /.input group -->
				</div>
				<!-- /.form group -->
			  </div>
			  <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
				<div class="form-group">
				  {!! Form::label('hour_end',trans('admin.hour_end')) !!}
				  <input type="time" name="hour_end" value={{$locations->hour_start}} class="form-control">
				  <!-- /.input group -->
				</div>
				<!-- /.form group -->
			  </div>

		</div>
		<!-- /.row -->
	</div>
	<!-- /.card-body -->
	<div class="card-footer"><button type="submit" name="save" class="btn btn-primary btn-flat"><i
				class="fa fa-save"></i> {{ trans('admin.save') }}</button>
		<button type="submit" name="save_back" class="btn btn-success btn-flat"><i class="fa fa-save"></i> {{
			trans('admin.save_back') }}</button>
		{!! Form::close() !!}
	</div>
</div>
@endsection