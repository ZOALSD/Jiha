<!-- Add icons to the links using the .nav-icon class
with font-awesome or any other icon font library -->
<li class="nav-header"></li>
<li class="nav-item">
  <a href="{{ aurl('') }}" class="nav-link {{ active_link(null,'active') }}">
    <i class="nav-icon fas fa-home"></i>
    <p>
      {{ trans('admin.dashboard') }}
    </p>
  </a>
</li>
{{-- @if(admin()->user()->role('settings_show'))
<li class="nav-item">
  <a href="{{ aurl('settings') }}" class="nav-link  {{ active_link('settings','active') }}">
    <i class="nav-icon fas fa-cogs"></i>
    <p>
      {{ trans('admin.settings') }}
    </p>
  </a>
</li>
@endif --}}
@if(admin()->user()->role("admins_show"))
<li class="nav-item {{ active_link('admins','menu-open') }}">
  <a href="#" class="nav-link  {{ active_link('admins','active') }}">
    <i class="nav-icon fas fa-users"></i>
    <p>
      {{trans('admin.admins')}}
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{aurl('admins')}}" class="nav-link {{ active_link('admins','active') }}">
        <i class="fas fa-users nav-icon"></i>
        <p>{{trans('admin.admins')}}</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ aurl('admins/create') }}" class="nav-link">
        <i class="fas fa-plus nav-icon"></i>
        <p>{{trans('admin.create')}}</p>
      </a>
    </li>
  </ul>
</li>
@endif
@if(admin()->user()->role("admingroups_show"))
<li class="nav-item {{ active_link('admingroups','menu-open') }}">
  <a href="#" class="nav-link  {{ active_link('admingroups','active') }}">
    <i class="nav-icon fas fa-users"></i>
    <p>
      {{trans('admin.admingroups')}}
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{aurl('admingroups')}}" class="nav-link {{ active_link('admingroups','active') }}">
        <i class="fas fa-users nav-icon"></i>
        <p>{{trans('admin.admingroups')}}</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ aurl('admingroups/create') }}" class="nav-link ">
        <i class="fas fa-plus nav-icon"></i>
        <p>{{trans('admin.create')}}</p>
      </a>
    </li>
  </ul>
</li>
@endif
<!--categories_start_route-->
@if(admin()->user()->role("categories_show"))
<li class="nav-item {{active_link('categories','menu-open')}} ">
  <a href="#" class="nav-link {{active_link('categories','active')}}">
    <i class="nav-icon fa fa-icons"></i>
    <p>
      {{trans('admin.categories')}} 
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{aurl('categories')}}" class="nav-link  {{active_link('categories','active')}}">
        <i class="fa fa-icons nav-icon"></i>
        <p>{{trans('admin.categories')}} </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ aurl('categories/create') }}" class="nav-link">
        <i class="fas fa-plus nav-icon"></i>
        <p>{{trans('admin.create')}} </p>
      </a>
    </li>
  </ul>
</li>
@endif
<!--categories_end_route-->

<!--productscontrollrt_start_route-->
@if(admin()->user()->role("productscontrollrt_show"))
<li class="nav-item {{active_link('productscontrollrt','menu-open')}} ">
  <a href="#" class="nav-link {{active_link('productscontrollrt','active')}}">
    <i class="nav-icon fa fa-icons"></i>
    <p>
      {{trans('admin.productscontrollrt')}} 
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{aurl('productscontrollrt')}}" class="nav-link  {{active_link('productscontrollrt','active')}}">
        <i class="fa fa-icons nav-icon"></i>
        <p>{{trans('admin.productscontrollrt')}} </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ aurl('productscontrollrt/create') }}" class="nav-link">
        <i class="fas fa-plus nav-icon"></i>
        <p>{{trans('admin.create')}} </p>
      </a>
    </li>
  </ul>
</li>
@endif
<!--productscontrollrt_end_route-->



<!--videos_start_route-->
@if(admin()->user()->role("videos_show"))
<li class="nav-item {{active_link('videos','menu-open')}} ">
  <a href="#" class="nav-link {{active_link('videos','active')}}">
    <i class="nav-icon fa fa-icons"></i>
    <p>
      {{trans('admin.videos')}} 
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{aurl('videos')}}" class="nav-link  {{active_link('videos','active')}}">
        <i class="fa fa-icons nav-icon"></i>
        <p>{{trans('admin.videos')}} </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ aurl('videos/create') }}" class="nav-link">
        <i class="fas fa-plus nav-icon"></i>
        <p>{{trans('admin.create')}} </p>
      </a>
    </li>
  </ul>
</li>
@endif
<!--videos_end_route-->



<!--images_start_route-->
@if(admin()->user()->role("images_show"))
<li class="nav-item {{active_link('images','menu-open')}} ">
  <a href="#" class="nav-link {{active_link('images','active')}}">
    <i class="nav-icon fa fa-images"></i>
    <p>
      {{trans('admin.images')}} 
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{aurl('images')}}" class="nav-link  {{active_link('images','active')}}">
        <i class="fa fa-images nav-icon"></i>
        <p>{{trans('admin.images')}} </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ aurl('images/create') }}" class="nav-link">
        <i class="fas fa-plus nav-icon"></i>
        <p>{{trans('admin.create')}} </p>
      </a>
    </li>
  </ul>
</li>
@endif
<!--images_end_route-->

<!--locations_start_route-->
@if(admin()->user()->role("locations_show"))
<li class="nav-item {{active_link('locations','menu-open')}} ">
  <a href="#" class="nav-link {{active_link('locations','active')}}">
    <i class="nav-icon fa fa-icons"></i>
    <p>
      {{trans('admin.locations')}} 
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{aurl('locations')}}" class="nav-link  {{active_link('locations','active')}}">
        <i class="fa fa-icons nav-icon"></i>
        <p>{{trans('admin.locations')}} </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ aurl('locations/create') }}" class="nav-link">
        <i class="fas fa-plus nav-icon"></i>
        <p>{{trans('admin.create')}} </p>
      </a>
    </li>
  </ul>
</li>
@endif
<!--locations_end_route-->

<!--sizes_start_route-->
@if(admin()->user()->role("sizes_show"))
<li class="nav-item {{active_link('sizes','menu-open')}} ">
  <a href="#" class="nav-link {{active_link('sizes','active')}}">
    <i class="nav-icon fa fa-icons"></i>
    <p>
      {{trans('admin.sizes')}} 
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{aurl('sizes')}}" class="nav-link  {{active_link('sizes','active')}}">
        <i class="fa fa-icons nav-icon"></i>
        <p>{{trans('admin.sizes')}} </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ aurl('sizes/create') }}" class="nav-link">
        <i class="fas fa-plus nav-icon"></i>
        <p>{{trans('admin.create')}} </p>
      </a>
    </li>
  </ul>
</li>
@endif
<!--sizes_end_route-->

<!--contacts_start_route-->
@if(admin()->user()->role("contacts_show"))

<li class="nav-item">
  <a href="{{aurl('contacts')}}" class="nav-link  {{active_link('contacts','active')}}">
    <i class="fa fa-icons nav-icon"></i>
    <p>{{trans('admin.contacts')}} </p>
  </a>
</li>

{{-- <li class="nav-item {{active_link('contacts','menu-open')}} ">
  <a href="#" class="nav-link {{active_link('contacts','active')}}">
    <i class="nav-icon fa fa-icons"></i>
    <p>
      {{trans('admin.contacts')}} 
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{aurl('contacts')}}" class="nav-link  {{active_link('contacts','active')}}">
        <i class="fa fa-icons nav-icon"></i>
        <p>{{trans('admin.contacts')}} </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ aurl('contacts/create') }}" class="nav-link">
        <i class="fas fa-plus nav-icon"></i>
        <p>{{trans('admin.create')}} </p>
      </a>
    </li>
  </ul>
</li> --}}
@endif
<!--contacts_end_route-->


<!--favorites_start_route-->
@if(admin()->user()->role("favorites_show"))

{{-- <li class="nav-item">
  <a href="{{aurl('favorites')}}" class="nav-link  {{active_link('favorites','active')}}">
    <i class="fa fa-icons nav-icon"></i>
    <p>{{trans('admin.favorites')}} </p>
  </a>
</li> --}}

{{-- <li class="nav-item {{active_link('favorites','menu-open')}} ">
  <a href="#" class="nav-link {{active_link('favorites','active')}}">
    <i class="nav-icon fa fa-icons"></i>
    <p>
      {{trans('admin.favorites')}} 
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{aurl('favorites')}}" class="nav-link  {{active_link('favorites','active')}}">
        <i class="fa fa-icons nav-icon"></i>
        <p>{{trans('admin.favorites')}} </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ aurl('favorites/create') }}" class="nav-link">
        <i class="fas fa-plus nav-icon"></i>
        <p>{{trans('admin.create')}} </p>
      </a>
    </li>
  </ul>
</li> --}}
@endif
<!--favorites_end_route-->

<!--services_start_route-->
@if(admin()->user()->role("services_show"))

<li class="nav-item">
  <a href="{{aurl('services')}}" class="nav-link  {{active_link('services','active')}}">
    <i class="fa fa-icons nav-icon"></i>
    <p>{{trans('admin.services')}} </p>
  </a>
</li>

{{-- <li class="nav-item {{active_link('services','menu-open')}} ">
  <a href="#" class="nav-link {{active_link('services','active')}}">
    <i class="nav-icon fa fa-icons"></i>
    <p>
      {{trans('admin.services')}} 
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{aurl('services')}}" class="nav-link  {{active_link('services','active')}}">
        <i class="fa fa-icons nav-icon"></i>
        <p>{{trans('admin.services')}} </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ aurl('services/create') }}" class="nav-link">
        <i class="fas fa-plus nav-icon"></i>
        <p>{{trans('admin.create')}} </p>
      </a>
    </li>
  </ul>
</li> --}}
@endif
<!--services_end_route-->



<!--colors_start_route-->
@if(admin()->user()->role("colors_show"))
<li class="nav-item {{active_link('colors','menu-open')}} ">
  <a href="#" class="nav-link {{active_link('colors','active')}}">
    <i class="nav-icon fa fa-icons"></i>
    <p>
      {{trans('admin.colors')}} 
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{aurl('colors')}}" class="nav-link  {{active_link('colors','active')}}">
        <i class="fa fa-icons nav-icon"></i>
        <p>{{trans('admin.colors')}} </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ aurl('colors/create') }}" class="nav-link">
        <i class="fas fa-plus nav-icon"></i>
        <p>{{trans('admin.create')}} </p>
      </a>
    </li>
  </ul>
</li>
@endif
<!--colors_end_route-->

<!--customers_start_route-->
@if(admin()->user()->role("customers_show"))
<li class="nav-item">
  <a href="{{aurl('customers')}}" class="nav-link  {{active_link('customers','active')}}">
    <i class="fa fa-icons nav-icon"></i>
    <p>{{trans('admin.customers')}} </p>
  </a>
</li>

{{-- <li class="nav-item {{active_link('customers','menu-open')}} ">
  <a href="#" class="nav-link {{active_link('customers','active')}}">
    <i class="nav-icon fa fa-icons"></i>
    <p>
      {{trans('admin.customers')}} 
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{aurl('customers')}}" class="nav-link  {{active_link('customers','active')}}">
        <i class="fa fa-icons nav-icon"></i>
        <p>{{trans('admin.customers')}} </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ aurl('customers/create') }}" class="nav-link">
        <i class="fas fa-plus nav-icon"></i>
        <p>{{trans('admin.create')}} </p>
      </a>
    </li>
  </ul>
</li> --}}
@endif
<!--customers_end_route-->

<!--orderviews_start_route-->
@if(admin()->user()->role("orderviews_show"))
<li class="nav-item">
  <a href="{{aurl('orderviews')}}" class="nav-link  {{active_link('orderviews','active')}}">
    <i class="fa fa-icons nav-icon"></i>
    <p>{{trans('admin.orderviews')}} </p>
  </a>
</li>
@endif
<!--orderviews_end_route-->

<!--generals_start_route-->
@if(admin()->user()->role("generals_show"))

<li class="nav-item">
  <a href="{{aurl('generals')}}" class="nav-link  {{active_link('generals','active')}}">
    <i class="fa fa-icons nav-icon"></i>
    <p>{{trans('admin.generals')}} </p>
  </a>
</li>

{{-- <li class="nav-item {{active_link('generals','menu-open')}} ">
  <a href="#" class="nav-link {{active_link('generals','active')}}">
    <i class="nav-icon fa fa-icons"></i>
    <p>
      {{trans('admin.generals')}} 
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{aurl('generals')}}" class="nav-link  {{active_link('generals','active')}}">
        <i class="fa fa-icons nav-icon"></i>
        <p>{{trans('admin.generals')}} </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ aurl('generals/create') }}" class="nav-link">
        <i class="fas fa-plus nav-icon"></i>
        <p>{{trans('admin.create')}} </p>
      </a>
    </li>
  </ul>
</li> --}}
@endif
<!--generals_end_route-->
