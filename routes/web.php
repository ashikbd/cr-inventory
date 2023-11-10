<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;

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

Route::get('/', function () {
    return redirect('admin/dashboard');
});
/*
Route::get('/generate_pw', function () {
    return Hash::make("evepw123xyz");
});
*/




//Route::prefix('admin')->group(function () {
   // Route::get('/dashboard', DashboardController::class, 'index');
//});
Route::get('admin/login', 'App\Http\Controllers\Admin\LoginController@index')->name('admin.login');
Route::post('admin/authenticate', 'App\Http\Controllers\Admin\LoginController@authenticate');
Route::get('admin/logout', 'App\Http\Controllers\Admin\LoginController@logout');



Route::middleware('auth')->prefix('admin')->group(function () {
    

    Route::get('/dashboard', 'App\Http\Controllers\Admin\DashboardController@index');
    
    Route::get('/products/delete/{id}', 'App\Http\Controllers\Admin\ProductController@delete');
    Route::resource('/products', 'App\Http\Controllers\Admin\ProductController');
    
    Route::get('/categories/delete/{id}', 'App\Http\Controllers\Admin\CategoryController@delete');
    Route::resource('/categories', 'App\Http\Controllers\Admin\CategoryController');
    
    Route::get('/brands/delete/{id}', 'App\Http\Controllers\Admin\ProductBrandsController@delete');
    Route::resource('/brands', 'App\Http\Controllers\Admin\ProductBrandsController');

    Route::get('/stock', 'App\Http\Controllers\Admin\StockController@index');

    Route::get('/stock/stockin_list', 'App\Http\Controllers\Admin\StockController@stockin_list');
    Route::get('/stock/stockin', 'App\Http\Controllers\Admin\StockController@stockin');
    Route::get('/stock/stockin_edit/{id}', 'App\Http\Controllers\Admin\StockController@stockin_edit');
    Route::get('/stock/stockin_detail/{id}', 'App\Http\Controllers\Admin\StockController@stockin_detail');   
    Route::post('/stock/stockin_save', 'App\Http\Controllers\Admin\StockController@stockin_save');
    Route::post('/stock/stockin_update', 'App\Http\Controllers\Admin\StockController@stockin_update');


    Route::get('/stock/stockout_list', 'App\Http\Controllers\Admin\StockController@stockout_list');    
    Route::get('/stock/stockout', 'App\Http\Controllers\Admin\StockController@stockout');
    Route::post('/stock/stockout_save', 'App\Http\Controllers\Admin\StockController@stockout_save');
    Route::get('/stock/stockout_edit/{id}', 'App\Http\Controllers\Admin\StockController@stockout_edit');
    Route::post('/stock/stockout_update', 'App\Http\Controllers\Admin\StockController@stockout_update');
    Route::get('/stock/stockout_detail/{id}', 'App\Http\Controllers\Admin\StockController@stockout_detail');

    Route::post('/stock/get_product_stock', 'App\Http\Controllers\Admin\StockController@get_product_stock');

    Route::get('/stock/current_stock', 'App\Http\Controllers\Admin\StockController@index');
    Route::get('/stock/show_transaction/{id}', 'App\Http\Controllers\Admin\StockController@show_transaction');
    Route::get('/stock/show_expiry_dates/{id}', 'App\Http\Controllers\Admin\StockController@show_expiry_dates');
    Route::get('/stock/expiring', 'App\Http\Controllers\Admin\StockController@expiring');

    Route::get('/clients/delete/{id}', 'App\Http\Controllers\Admin\ClientController@delete');
    Route::get('/clients/birthdays', 'App\Http\Controllers\Admin\ClientController@birthdays');
    Route::get('/clients/send_sms_modal/{id}', 'App\Http\Controllers\Admin\ClientController@send_sms_modal');
    Route::post('/clients/send_sms','App\Http\Controllers\Admin\ClientController@send_sms');
    Route::resource('/clients', 'App\Http\Controllers\Admin\ClientController');


    
    Route::get('/services/delete/{id}', 'App\Http\Controllers\Admin\ServiceController@delete');
    Route::resource('/services', 'App\Http\Controllers\Admin\ServiceController');
    
    Route::get('/sales/delete/{id}', 'App\Http\Controllers\Admin\ClientServiceController@delete');
    Route::get('/sales/detail/{id}', 'App\Http\Controllers\Admin\ClientServiceController@sale_detail');
    Route::resource('/sales', 'App\Http\Controllers\Admin\ClientServiceController');

    Route::get('/users/delete/{id}', 'App\Http\Controllers\Admin\UserController@delete');
    Route::resource('users', 'App\Http\Controllers\Admin\UserController');

    Route::get('/settings/sms_settings', 'App\Http\Controllers\Admin\SettingsController@sms_settings');
    Route::post('/settings/sms_settings_save', 'App\Http\Controllers\Admin\SettingsController@sms_settings_save');
});

