@extends('admin.index')
@section('content')

@include("admin.layouts.components.submit_form_ajax",["form"=>"#servicesus"])
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
				<a href="{{ aurl('servicesus') }}"  style="color:#343a40"  class="dropdown-item">
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
								
{!! Form::open(['url'=>aurl('/servicesus'),'id'=>'servicesus','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}
<div class="row">

<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
	<div class="form-group">
		{!! Form::label('user_id',trans('admin.user_id')) !!}
		{!! Form::select('user_id',App\Models\User::pluck('first_name','id'),old('user_id'),['class'=>'form-control select2','placeholder'=>trans('admin.choose')]) !!}
	</div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
	<div class="form-group">
		{!! Form::label('services_type_id',trans('admin.services_type_id')) !!}
		{!! Form::select('services_type_id',App\Models\Servicetype::pluck('name','id'),old('services_type_id'),['class'=>'form-control select2','placeholder'=>trans('admin.choose')]) !!}
	</div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
    <div class="form-group">
        {!! Form::label('name',trans('admin.name'),['class'=>' control-label']) !!}
            {!! Form::text('name',old('name'),['class'=>'form-control','placeholder'=>trans('admin.name')]) !!}
    </div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 image_ID">
    <div class="form-group">
        <label for="'image_ID'">{{ trans('admin.image_ID') }}</label>
        <div class="input-group">
            <div class="custom-file">
                {!! Form::file('image_ID',['class'=>'custom-file-input','placeholder'=>trans('admin.image_ID'),"accept"=>it()->acceptedMimeTypes("image"),"id"=>"image_ID"]) !!}
                {!! Form::label('image_ID',trans('admin.image_ID'),['class'=>'custom-file-label']) !!}
            </div>
            <div class="input-group-append">
                <span class="input-group-text" id="">{{ trans('admin.upload') }}</span>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
    <div class="form-group">
        {!! Form::label('shop_name',trans('admin.shop_name'),['class'=>' control-label']) !!}
            {!! Form::text('shop_name',old('shop_name'),['class'=>'form-control','placeholder'=>trans('admin.shop_name')]) !!}
    </div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
    <div class="form-group">
        {!! Form::label('phone',trans('admin.phone'),['class'=>' control-label']) !!}
            {!! Form::text('phone',old('phone'),['class'=>'form-control','placeholder'=>trans('admin.phone')]) !!}
    </div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
    <div class="form-group">
        {!! Form::label('other_phone',trans('admin.other_phone'),['class'=>' control-label']) !!}
            {!! Form::text('other_phone',old('other_phone'),['class'=>'form-control','placeholder'=>trans('admin.other_phone')]) !!}
    </div>
</div>
<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
    <div class="form-group">
        {!! Form::label('disc',trans('admin.disc'),['class'=>'control-label']) !!}
            {!! Form::textarea('disc',old('disc'),['class'=>'form-control','placeholder'=>trans('admin.disc')]) !!}
    </div>
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