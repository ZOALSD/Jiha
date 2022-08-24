<?php
use Illuminate\Support\Facades\Route;


Route::group(['prefix'=>app('admin'),'middleware'=>'Lang'],function(){
	Route::get('lock/screen','Admin\AdminAuthenticated@lock_screen');
	Route::get('theme/{id}','Admin\Dashboard@theme');
	Route::group(['middleware'=>'admin_guest'],function(){

		Route::get('login','Admin\AdminAuthenticated@login_page');
		Route::post('login','Admin\AdminAuthenticated@login_post');
		Route::view('forgot/password','admin.forgot_password');

		Route::post('reset/password','Admin\AdminAuthenticated@reset_password');
		Route::get('password/reset/{token}','Admin\AdminAuthenticated@reset_password_final');
		Route::post('password/reset/{token}','Admin\AdminAuthenticated@reset_password_change');
	});

	Route::view('need/permission','admin.no_permission');

	Route::group(['middleware'=>'admin:admin'],function(){
		if(class_exists(\UniSharp\LaravelFilemanager\Lfm::class)){
			Route::group(['prefix'=>'filemanager'],function(){
				\UniSharp\LaravelFilemanager\Lfm::routes();
			});
		}

		////////AdminRoutes/*Start*///////////////
		Route::get('/','Admin\Dashboard@home');
		Route::any('logout','Admin\AdminAuthenticated@logout');
		Route::get('account','Admin\AdminAuthenticated@account');
		Route::post('account','Admin\AdminAuthenticated@account_post');
		Route::resource('settings','Admin\Settings');
		Route::resource('admingroups','Admin\AdminGroups');
		Route::post('admingroups/multi_delete','Admin\AdminGroups@multi_delete');
		Route::resource('admins','Admin\Admins');
		Route::post('admins/multi_delete','Admin\Admins@multi_delete');
		Route::resource('categories','Admin\categories');
		Route::post('categories/multi_delete','Admin\categories@multi_delete');
		Route::resource('productscontrollrt','Admin\productsControllrt');
		Route::post('productscontrollrt/multi_delete','Admin\productsControllrt@multi_delete');
		
		
		
		
		Route::resource('videos','Admin\Videos');
		Route::post('videos/multi_delete','Admin\Videos@multi_delete');
		
		
		Route::resource('images','Admin\Images'); 
		Route::post('images/multi_delete','Admin\Images@multi_delete'); 
		Route::resource('locations','Admin\Locations'); 
		Route::post('locations/multi_delete','Admin\Locations@multi_delete'); 
		Route::get('contacts','Admin\Contacts@index'); 
		Route::get('contacts/{id}','Admin\Contacts@show'); 
		Route::post('contacts/multi_delete','Admin\Contacts@multi_delete'); 
		Route::resource('favorites','Admin\Favorites'); 
		Route::post('favorites/multi_delete','Admin\Favorites@multi_delete'); 
		Route::resource('services','Admin\Services'); 
		Route::post('services/multi_delete','Admin\Services@multi_delete'); 
		Route::resource('sizes','Admin\Sizes'); 
		Route::post('sizes/multi_delete','Admin\Sizes@multi_delete'); 
		Route::resource('colors','Admin\Colors'); 
		Route::post('colors/multi_delete','Admin\Colors@multi_delete'); 
		Route::resource('customers','Admin\Customers'); 
		// Route::get('customers','Admin\Customers@index'); 
		Route::resource('orderviews','Admin\Orderviews'); 
		Route::post('orderviews/multi_delete','Admin\Orderviews@multi_delete'); 
		Route::get('/orderviews/seen/{id}','Admin\Orderviews@seen');
		Route::resource('generals','Admin\Generals'); 
		Route::post('generals/multi_delete','Admin\Generals@multi_delete'); 
		////////AdminRoutes/*End*///////////////
		Route::get('order/show','admin\ProductOrder@index')->name('orders');
	});

});