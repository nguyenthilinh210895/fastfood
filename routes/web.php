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

Route::get('/', 'ClientController@getIndex');


Route::get('admin/login', 'AdminController@getLogin');
Route::post('admin/login', 'AdminController@postLogin');
Route::middleware(['adminLogin'])->group(function () {
	Route::group(['prefix' => 'admin'], function () {
		Route::get('/index', 'AdminController@getIndex');
    // manage staff
		Route::get('/staff/list', 'AdminController@getListStaff');
		Route::get('/staff/add', 'AdminController@getAddStaff');
		Route::post('/staff/add', 'AdminController@postAddStaff');
		Route::get('/staff/edit/{id}', 'AdminController@getEditStaff');
		Route::post('/staff/edit/{id}', 'AdminController@postEditStaff');
		Route::get('/staff/delete/{id}', 'AdminController@getDeleteStaff');
	});
});
