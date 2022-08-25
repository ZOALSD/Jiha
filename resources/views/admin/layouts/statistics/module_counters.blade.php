<!--orderviews_start-->
@if(admin()->user()->role("orderviews_show"))

<div class="col-lg-6 col-6">
  <!-- small box -->
  <div class="small-box bg-primary">
    <div class="inner">
      <h3>@livewire('show-invoices')</h3>
      <p>{{ trans("admin.orderviews") }}</p>
    </div>
    <div class="icon">
      <i class="fa fa-icons"></i>
    </div>
    <a href="{{ aurl("orderviews") }}" class="small-box-footer">{{ trans("admin.orderviews") }} <i
        class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>
@endif
<!--orderviews_end-->
@if(admin()->user()->role("admingroups_show"))
<!--admingroups_start-->
<div class="col-lg-3 col-6">
  <!-- small box -->
  <div class="small-box bg-success">
    <div class="inner">
      <h3>{{ App\Models\AdminGroup::count() }}</h3>
      <p>{{ trans('admin.admingroups') }}</p>
    </div>
    <div class="icon">
      <i class="fas fa-users"></i>
    </div>
    <a href="{{ aurl('admingroups') }}" class="small-box-footer">{{ trans('admin.admingroups') }} <i
        class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>
<!--admingroups_end-->
@endif
<!--admins_start-->
@if(admin()->user()->role("admins_show"))

<div class="col-lg-3 col-6">
  <!-- small box -->
  <div class="small-box bg-success">
    <div class="inner">
      <h3>{{ App\Models\Admin::count() }}</h3>
      <p>{{ trans('admin.admins') }}</p>
    </div>
    <div class="icon">
      <i class="fas fa-users"></i>
    </div>
    <a href="{{ aurl('admins') }}" class="small-box-footer">{{ trans('admin.admins') }} <i
        class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>
<!--admins_end-->
@endif

@if(admin()->user()->role("categories_show"))
<!--categories_start-->
<div class="col-lg-3 col-6">
  <!-- small box -->
  <div class="small-box bg-primary">
    <div class="inner">
      <h3>{{ mK(App\Models\category::count()) }}</h3>
      <p>{{ trans("admin.categories") }}</p>
    </div>
    <div class="icon">
      <i class="fa fa-icons"></i>
    </div>
    <a href="{{ aurl("categories") }}" class="small-box-footer">{{ trans("admin.categories") }} <i
        class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>
<!--categories_end-->
@endif
@if(admin()->user()->role("productscontrollrt_show"))
<!--productscontrollrt_start-->
<div class="col-lg-3 col-6">
  <!-- small box -->
  <div class="small-box bg-primary">
    <div class="inner">
      <h3>{{ mK(App\Models\product::count()) }}</h3>
      <p>{{ trans("admin.productscontrollrt") }}</p>
    </div>
    <div class="icon">
      <i class="fa fa-icons"></i>
    </div>
    <a href="{{ aurl("productscontrollrt") }}" class="small-box-footer">{{ trans("admin.productscontrollrt") }} <i
        class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>
<!--productscontrollrt_end-->
@endif
@if(admin()->user()->role("videos_show"))
<!--videos_start-->
<div class="col-lg-3 col-6">
  <!-- small box -->
  <div class="small-box bg-primary">
    <div class="inner">
      <h3>{{ mK(App\Models\video::count()) }}</h3>
      <p>{{ trans("admin.videos") }}</p>
    </div>
    <div class="icon">
      <i class="fa fa-icons"></i>
    </div>
    <a href="{{ aurl("videos") }}" class="small-box-footer">{{ trans("admin.videos") }} <i
        class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>
<!--videos_end-->
@endif
@if(admin()->user()->role("images_show"))

<!--images_start-->
<div class="col-lg-3 col-6">
  <!-- small box -->
  <div class="small-box bg-primary">
    <div class="inner">
      <h3>{{ mK(App\Models\Image::count()) }}</h3>
      <p>{{ trans("admin.images") }}</p>
    </div>
    <div class="icon">
      <i class="fa fa-images"></i>
    </div>
    <a href="{{ aurl("images") }}" class="small-box-footer">{{ trans("admin.images") }} <i
        class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>
@endif
<!--images_end-->

@if(admin()->user()->role("locations_show"))

<!--locations_start-->
<div class="col-lg-3 col-6">
  <!-- small box -->
  <div class="small-box bg-primary">
    <div class="inner">
      <h3>{{ mK(App\Models\Location::count()) }}</h3>
      <p>{{ trans("admin.locations") }}</p>
    </div>
    <div class="icon">
      <i class="fa fa-icons"></i>
    </div>
    <a href="{{ aurl("locations") }}" class="small-box-footer">{{ trans("admin.locations") }} <i
        class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>
<!--locations_end-->
@endif

@if(admin()->user()->role("contacts_show"))

<!--contacts_start-->
<div class="col-lg-3 col-6">
  <!-- small box -->
  <div class="small-box bg-primary">
    <div class="inner">
      <h3>{{ mK(App\Models\Contact::count()) }}</h3>
      <p>{{ trans("admin.contacts") }}</p>
    </div>
    <div class="icon">
      <i class="fa fa-icons"></i>
    </div>
    <a href="{{ aurl("contacts") }}" class="small-box-footer">{{ trans("admin.contacts") }} <i
        class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>
<!--contacts_end-->
@endif
@if(admin()->user()->role("favorites_show"))

<!--favorites_start-->
<div class="col-lg-3 col-6">
  <!-- small box -->
  <div class="small-box bg-primary">
    <div class="inner">
      <h3>{{ mK(App\Models\Favorite::count()) }}</h3>
      <p>{{ trans("admin.favorites") }}</p>
    </div>
    <div class="icon">
      <i class="fa fa-icons"></i>
    </div>
    <a href="{{ aurl("favorites") }}" class="small-box-footer">{{ trans("admin.favorites") }} <i
        class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>
<!--favorites_end-->
@endif
@if(admin()->user()->role("services_show"))

<!--services_start-->
<div class="col-lg-3 col-6">
  <!-- small box -->
  <div class="small-box bg-primary">
    <div class="inner">
      <h3>{{ mK(App\Models\Service::count()) }}</h3>
      <p>{{ trans("admin.services") }}</p>
    </div>
    <div class="icon">
      <i class="fa fa-icons"></i>
    </div>
    <a href="{{ aurl("services") }}" class="small-box-footer">{{ trans("admin.services") }} <i
        class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>
<!--services_end-->
@endif
@if(admin()->user()->role("sizes_show"))
<!--sizes_start-->
<div class="col-lg-3 col-6">
  <!-- small box -->
  <div class="small-box bg-primary">
    <div class="inner">
      <h3>{{ mK(App\Models\Size::count()) }}</h3>
      <p>{{ trans("admin.sizes") }}</p>
    </div>
    <div class="icon">
      <i class="fa fa-icons"></i>
    </div>
    <a href="{{ aurl("sizes") }}" class="small-box-footer">{{ trans("admin.sizes") }} <i
        class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>
<!--sizes_end-->
@endif
@if(admin()->user()->role("colors_show"))

<!--colors_start-->
<div class="col-lg-3 col-6">
  <!-- small box -->
  <div class="small-box bg-primary">
    <div class="inner">
      <h3>{{ mK(App\Models\Color::count()) }}</h3>
      <p>{{ trans("admin.colors") }}</p>
    </div>
    <div class="icon">
      <i class="fa fa-icons"></i>
    </div>
    <a href="{{ aurl("colors") }}" class="small-box-footer">{{ trans("admin.colors") }} <i
        class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>
<!--colors_end-->
@endif
@if(admin()->user()->role("customers_show"))
<!--customers_start-->
<div class="col-lg-3 col-6">
  <!-- small box -->
  <div class="small-box bg-primary">
    <div class="inner">
      <h3>{{ mK(App\Models\Customer::count()) }}</h3>
      <p>{{ trans("admin.customers") }}</p>
    </div>
    <div class="icon">
      <i class="fa fa-icons"></i>
    </div>
    <a href="{{ aurl("customers") }}" class="small-box-footer">{{ trans("admin.customers") }} <i
        class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>
@endif
<!--customers_end-->
@if(admin()->user()->role("generals_show"))

<!--generals_start-->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-primary">
      <div class="inner">
        <h3>{{ App\Models\General::where('id',1)->value('price') ." ". "SD"}}</h3>
        <p>{{ trans("admin.generals") }}</p>
      </div>
      <div class="icon">
        <i class="fa fa-icons"></i>
      </div>
      <a href="{{ aurl('/generals/1/edit') }}" class="small-box-footer">{{ trans("admin.generals") }} <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!--generals_end-->
@endif

<!--servicestype_start-->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-primary">
      <div class="inner">
        <h3>{{ mK(App\Models\Servicetype::count()) }}</h3>
        <p>{{ trans("admin.servicestype") }}</p>
      </div>
      <div class="icon">
        <i class="fa fa-icons"></i>
      </div>
      <a href="{{ aurl("servicestype") }}" class="small-box-footer">{{ trans("admin.servicestype") }} <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!--servicestype_end-->
<!--servicesus_start-->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-primary">
      <div class="inner">
        <h3>{{ mK(App\Models\Serviceus::count()) }}</h3>
        <p>{{ trans("admin.servicesus") }}</p>
      </div>
      <div class="icon">
        <i class="fa fa-icons"></i>
      </div>
      <a href="{{ aurl("servicesus") }}" class="small-box-footer">{{ trans("admin.servicesus") }} <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!--servicesus_end-->