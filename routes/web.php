<?php

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

Auth::routes();
Route::get('/', 'DashController@index')->middleware('auth');
Route::get('/dashboard', 'DashController@index')->middleware('auth');

Route::resource('profile', 'UserController')->middleware('auth');
Route::resource('clientes', 'ClientController')->middleware('auth');
Route::resource('prestamos', 'PrestamoController')->middleware('auth');
Route::resource('pagos', 'PagoController', ['except' => ['create']])->middleware('auth');
Route::get('pagos/{pago}/create', 'PagoController@create')->name('pagos.create')->middleware('auth');

Route::get('/logout', function()
	{
		Auth::logout();
	Session::flush();
		return Redirect::to('/');
	});
