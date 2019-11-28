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

Route::group(['middleware' => 'auth'],function () {

	Route::get('/', 'HomeController@index');

	Route::resource('/home', 'HomeController');
	Route::get('/elibrary', 'HomeController@elibrary');
	Route::resource('/book', 'BookController');
	Route::resource('/ebook', 'EbookController');
	Route::resource('/laporan', 'LaporanController');

	Route::resource('/category', 'CategoryController');
	Route::resource('/volume', 'VolumeController');
	Route::resource('/transaction', 'TransactionController');
	Route::resource('/transactionDetail', 'TransactionDetailController');
	Route::get('/transaction/{id}/receipt', 'TransactionController@receipt')->name('transaction.receipt');
	Route::get('/transaction/{id}/{title}/addItem', 'TransactionController@addItem')->name('transaction.addItem');
	Route::get('/transaction/{id}/removeItem', 'TransactionController@removeItem')->name('transaction.removeItem');
	Route::get('/transaction/{id}/return', 'TransactionController@return')->name('transaction.return');
	
});


Route::group(['prefix' => 'admin'],function () {

	Route::resource('/setting', 'Admin\SettingController');
    Route::resource('/users', 'Admin\UserController');
	Route::resource('/roles', 'Admin\RoleController');
	Route::resource('/permissions', 'Admin\PermissionController');
	
});