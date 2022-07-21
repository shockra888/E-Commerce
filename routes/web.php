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

use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\AdminAddController\LoginController;
use App\Http\Controllers\AddProductController;
use App\Http\Controllers\Pshow;
use App\Http\Controllers\SearchController;

Route::get('/', function () {
    return view('LogIn');
});
Route::get('policy', function () {
    return view('Policies');
});
Route::get('AdminHome', 'UserAuthController@Adminhome')->name('Adminhome');
Route::get('SupplierHome', 'UserAuthController@Supplierhome');
Auth::routes();
Route::get('signup', 'UserAuthController@Signup');
Route::post('check', 'UserAuthController@check')->name('check');

Route::resource('AddCustomer', 'AddingCustomerController');
Route::resource('AddAdmin', 'AddingAdminController');
Route::resource('AddSupplier', 'AddingSupplierController');
Route::resource('AddProduct', 'AddProductController');
Route::resource('AddOrder', 'AddOrderController');
Route::resource('SetOrder','SetOrderController');
Route::get('logout', 'UserAuthController@logout');
Route::get('AdminHome', 'CountController@userCount');
Route::get('AddAdmin/{id}', 'AddingAdminController@show');
Route::get('AddSupplier/{id}', 'AddingSupplierController@show');
Route::get('AddCustomer/{id}', 'AddingCustomerController@show');
Route::get('AddOrder/{id}', 'SetOrderController@show')->name('show');
Route::get('DelProd/{id}', 'AddProductController@delete')->name('delete');
Route::get('SetOrder/create/{id}', 'SetOrderController@create')->name('create');
Route::get('SupplierHome', 'CountController@products')->name('products');
Route::post('Pay/{id}','payment@pay')->name('pay');
Route::get('SalesView','CountController@Showsales');
Route::get('ViewSales','CountController@Suppsales');
Route::get('search', 'SearchController@SearchAction');
Route::get('/search/action','SearchController@SearchOrder')->name('search.action');
Route::get('searchprod', 'SearchController@SearchProd');
Route::get('searchsales', 'SearchController@SearchSales');
Route::get('searchproduct', 'SearchController@SearchProduct');
Route::get('searchcustomer', 'SearchController@SearchCustomer');
Route::get('searchsupplier', 'SearchController@SearchSupplier');
Route::get('searchingsales', 'SearchController@SearchingSales');
Route::get('viewsales','CountController@Suppsales');