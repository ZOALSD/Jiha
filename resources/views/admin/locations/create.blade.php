@extends('admin.index')
@section('content')


<div class="card card-dark">
	<div class="card-header">
		<h3 class="card-title">
		<div class="">
			<span>
			{{ !empty($title)?$title:'' }}
			</span>
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			<span class="caret"></span>
			<span class="sr-only"></span>
			</a>
			<div class="dropdown-menu" role="menu">
				<a href="{{ aurl('locations') }}"  style="color:#343a40"  class="dropdown-item">
				<i class="fas fa-list"></i> {{ trans('admin.show_all') }}</a>
			</div>
		</div>
		</h3>
		<div class="card-tools">
			<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
			<button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
		</div>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
								
{!! Form::open(['url'=>aurl('/locations'),'id'=>'locations','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}
<div class="row">

{{-- <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
    <div class="form-group">
        {!! Form::label('days_wrok',trans('admin.days_wrok'),['class'=>' control-label']) !!}
            {!! Form::text('days_wrok',old('days_wrok'),['class'=>'form-control','placeholder'=>trans('admin.days_wrok')]) !!}
    </div>

</div> --}}

<div class="col-md">
    <div class="form-group">
      <label>Multiple</label>
      <select name="days_wrok[]" class="select2"  multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
        <option selected>Saturday</option>
        <option selected>Sunday</option>
        <option selected>Monday</option>
        <option selected>Tuesday</option>
        <option selected>Wednesday</option>
        <option selected>Thursday</option>
        <option>Friday</option>
      </select>
    </div>

<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
    <div class="form-group">
        {!! Form::label('location',trans('admin.location'),['class'=>' control-label']) !!}
            {!! Form::text('location',old('location'),['class'=>'form-control','placeholder'=>trans('admin.location')]) !!}
    </div>
</div>

<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
  <div class="form-group">
      {!! Form::label('phone',trans('admin.phone'),['class'=>' control-label']) !!}
          {!! Form::text('phone',old('phone'),['class'=>'form-control','placeholder'=>trans('admin.location')]) !!}
  </div>
</div>

<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
    <div class="form-group">
        {!! Form::label('lat',trans('admin.lat'),['class'=>' control-label']) !!}
            {!! Form::text('lat',old('lat'),['class'=>'form-control','placeholder'=>trans('admin.lat')]) !!}
    </div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
    <div class="form-group">
        {!! Form::label('lng',trans('admin.lng'),['class'=>' control-label']) !!}
            {!! Form::text('lng',old('lng'),['class'=>'form-control','placeholder'=>trans('admin.lng')]) !!}
    </div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
  <div class="form-group">
    {!! Form::label('hour_start',trans('admin.hour_start')) !!}
    <input type="time" name="hour_start" value="old('hour_start')" class="form-control">
    <!-- /.input group -->
  </div>
  <!-- /.form group -->
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
  <div class="form-group">
    {!! Form::label('hour_end',trans('admin.hour_end')) !!}
    <input type="time" name="hour_end" value="old('hour_end')" class="form-control">
    <!-- /.input group -->
  </div>
  <!-- /.form group -->
</div>

</div>
		<!-- /.row -->
	</div>
	<!-- /.card-body -->
	<div class="card-footer"><button type="submit" name="add" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> {{ trans('admin.add') }}</button>
<button type="submit" name="add_back" class="btn btn-success btn-flat"><i class="fa fa-plus"></i> {{ trans('admin.add_back') }}</button>
{!! Form::close() !!}	</div>
</div>
@endsection