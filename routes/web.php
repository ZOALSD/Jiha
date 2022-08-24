<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::group(
	['middleware' => 'auth'],

	function () {
		Route::any('logout', 'Auth\LoginController@logout')->name('web.logout');
	}
);

Route::get('/', function () {
	return view('welcome');
});

Route::get('dropall/15/8/22',function(){
	Artisan::call('migrate:fresh --seed');
	return "All Data Deleted ...";
});



Route::get('down/15/8/22',function(){
	Artisan::call('down');
});


// Route::any('storage/app/*',function(){
// 	abort(404);
// });


Route::any('storage/*', function () {
	return abort(404);
});

Route::any('storage', function () {
	return	abort(404);
});

// Route::middleware(ProtectAgainstSpam::class)->group(function () {
// 	Auth::routes(['verify' => true]);

// });
// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

