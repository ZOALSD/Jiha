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
                    <a href="{{ aurl('productscontrollrt') }}" style="color:#343a40" class="dropdown-item">
                        <i class="fas fa-list"></i> {{ trans('admin.show_all') }}</a>
                </div>
            </div>
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                    class="fas fa-expand"></i></button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">

        {!!
        Form::open(['url'=>aurl('/productscontrollrt'),'id'=>'productscontrollrt','files'=>true,'class'=>'form-horizontal
        form-row-seperated']) !!}
        <div class="row">

            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    {!! Form::label('name',trans('admin.name'),['class'=>' control-label']) !!}
                    {!! Form::text('name',old('name'),['class'=>'form-control','placeholder'=>trans('admin.name')]) !!}
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    {!! Form::label('price',trans('admin.price'),['class'=>' control-label']) !!}
                    {!! Form::text('price',old('price'),['class'=>'form-control','placeholder'=>trans('admin.price')])
                    !!}
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    {!! Form::label('category_id',trans('admin.category_id')) !!}
                    {!!
                    Form::select('category_id',App\Models\category::whereNotNull('parent_id')->pluck('name','id'),old('category_id'),['class'=>'form-control
                    select2','placeholder'=>trans('admin.choose')]) !!}
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 image">
                <div class="form-group">
                    <label for="'image'">{{ trans('admin.image') }}</label>
                    <div class="input-group">
                        <div class="custom-file">
                            {!!
                            Form::file('image',['class'=>'custom-file-input','placeholder'=>trans('admin.image'),"accept"=>it()->acceptedMimeTypes("image"),"id"=>"image"])
                            !!}
                            {!! Form::label('image',trans('admin.image'),['class'=>'custom-file-label']) !!}
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text" id="">{{ trans('admin.upload') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    {!! Form::label('colors',trans('admin.color')) !!}
                    {!! Form::select('colors[]',App\Models\Color::pluck('name','code'),'', ['class'=>'form-control
                    select2' ,'multiple'=> 'multiple' ,'data-placeholder'=>'Select a State']) !!}
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    {!! Form::label('size_id',trans('admin.size_id')) !!}
                    {!! Form::select('sizes[]',App\Models\Size::pluck('size','size'),'', ['class'=>'form-control
                    select2' ,'multiple'=> 'multiple' ,'data-placeholder'=>'Select a State']) !!}
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    {!! Form::label('desc_en',trans('admin.desc_en'),['class'=>'control-label']) !!}
                    {!!
                    Form::textarea('desc_en',old('desc_en'),['class'=>'form-control','placeholder'=>trans('admin.desc_en')])
                    !!}
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    {!! Form::label('desc_ar',trans('admin.desc_ar'),['class'=>'control-label']) !!}
                    {!!
                    Form::textarea('desc_ar',old('desc_ar'),['class'=>'form-control','placeholder'=>trans('admin.desc_ar')])
                    !!}
                </div>
            </div>

            @php
            $list = ['Not Available' , "Available"];
            @endphp

            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    {!! Form::label('available',"Stutus",['class'=>'control-label']) !!}
                    <select name="available" class=" form-control">
                        <option value="0">Not Available</option>
                        <option value="1" selected>Available</option>
                    </select>
                </div>
            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- /.card-body -->
    <div class="card-footer"><button type="submit" name="add" class="btn btn-primary btn-flat"><i
                class="fa fa-plus"></i> {{ trans('admin.add') }}</button>
        <button type="submit" name="add_back" class="btn btn-success btn-flat"><i class="fa fa-plus"></i> {{
            trans('admin.add_back') }}</button>
        {!! Form::close() !!}
    </div>
</div>
@endsection