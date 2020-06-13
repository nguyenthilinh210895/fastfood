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
Route::get('admin/logout', 'AdminController@getLogout');
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

		//manage product
		Route::get('/product/list', 'AdminController@getListProduct');
		Route::post('/category/add', 'AdminController@postAddCategory');
		Route::get('/category/delete/{id}', 'AdminController@getDeleteCategory');
		Route::post('/product/add', 'AdminController@getAddProduct');
		Route::get('/product/edit/{id}', 'AdminController@getEditProduct');
		Route::post('/product/edit/{id}', 'AdminController@postEditProduct');
		Route::get('/product/delete/{id}', 'AdminController@getDeleteProduct');

		// manage table
		Route::get('/table/list', 'AdminController@getListTable');
		Route::post('/table/add', 'AdminController@getAddTable');
		Route::get('/table/delete/{id}', 'AdminController@getDeleteTable');
		Route::get('/table/on/{id}', 'AdminController@getOnTable');
		Route::get('/table/off/{id}', 'AdminController@getOffTable');
		Route::get('/table/edit/{id}', 'AdminController@getEditTable');
		Route::post('/table/edit/{id}', 'AdminController@postEditTable');
		Route::get('/table/booktable', 'AdminController@getListBookTable');
		Route::get('/booktable/accept/{id}', 'AdminController@getAcceptBookTable');
		Route::get('/booktable/cancel/{id}', 'AdminController@getCancelBookTable');

		// manager receive
		Route::get('/receive/list', 'AdminController@getListReceive');
		Route::get('/receive/delete/{id}', 'AdminController@getDeleteReceive');
		Route::post('/receive/add', 'AdminController@postAddReceive');

		// manager timekeeping
		Route::get('/timekeeping/list', 'AdminController@getListTimeKeeping');
		Route::get('/timekeeping/delete/{id}', 'AdminController@getDeleteTimeKeeping');
		Route::post('/timekeeping/add', 'AdminController@postAddTimeKeeping');
		Route::get('/salary-staff', 'AdminController@getSalaryStaff');
		Route::get('/search-salary', 'AdminController@getSearchSalary');
		Route::get('/befenit', 'AdminController@getBefenit');
		Route::get('/search-befenit', 'AdminController@getSearchBefenit');

		//manage order
		Route::get('/order/list', 'AdminController@getListOrder');
		Route::get('/order/view/{id}', 'AdminController@getViewOrder');
		Route::get('/order/accept/{id}', 'AdminController@getAcceptOrder');
		Route::get('/order/complete/{id}', 'AdminController@getCompleteOrder');
		Route::get('/order/cancel/{id}', 'AdminController@getCancelOrder');
		Route::get('/order-review/list', 'AdminController@getListOrderReview');

		// search statistical
		Route::get('/search-statistical', 'AdminController@getSearchStatistical');

		// search revenue
		Route::get('/search-revenue', 'AdminController@getSearchRevenue');

		// info
		Route::get('/info', 'AdminController@getInfo');
		Route::post('/info/edit', 'AdminController@postInfo');

		Route::get('/getCountOrder', 'AjaxController@getCountOrder');
	});

});

// Client
Route::get('/login', 'ClientController@getLogin');
Route::post('/login', 'ClientController@postLogin');
Route::post('/register', 'ClientController@postRegister');
Route::get('/logout', 'ClientController@getLogout');
Route::get('/product-detail/{id}', 'ClientController@getProductDetails');
Route::post('/comment/{id}', 'ClientController@postComment');
Route::get('/sales-off', 'ClientController@getSaleOff');
Route::get('/introduce', 'ClientController@getIntroduce');
Route::post('/booktable', 'ClientController@postBookTable');
// cart
Route::get('add-to-cart/{id}', [
	'as'=>'addcart',
	'uses'=>'ClientController@getAddtoCart'
]);
Route::get('add-multiple-cart/{id}', [
	'as'=>'addmultiplecart',
	'uses'=>'ClientController@getAddMultipletoCart'
]);
Route::get('update-cart', [
	'as'=>'updatecart',
	'uses'=>'ClientController@getUpdateCart'
]);
Route::get('del-cart/{id}', [
	'as'=>'delete-cart',
	'uses'=>'ClientController@getDelItemCart'
]);
Route::get('cart', 'ClientController@getCart');
Route::get('search-product', 'ClientController@getsearchProduct');
Route::get('product/{id}', 'ClientController@getProductByCategory');
Route::get('checkout', 'ClientController@getCheckout');
Route::post('accept-order-online', 'ClientController@postAcceptOrderOnline');
Route::post('accept-order-offline', 'ClientController@postAcceptOrderOffline');
Route::get('/checkout-success', function(){
	return view('/client.checkout.complete');
});

route::get('/info', 'ClientController@getInfo');
route::post('/update-info', 'ClientController@postInfo');
Route::get('/change-password', 'ClientController@getChangePass');
Route::post('/change-password', 'ClientController@postChangePass');
Route::get('/history-order', 'ClientController@getHistoryOrder');
Route::get('/order/view/{id}', 'ClientController@getBill');

//ajax
Route::get('/ajax/add-to-card', 'AjaxController@getAddToCard');