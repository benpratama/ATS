<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/hrdats/dashboard/hrd', 'HomeController@index')->name('home');

//Master Table Internal
Route::get('/hrdats/mt/internal', 'MasterTableController@indexInternal')->name('mt.internal');

//Master Table Form
Route::get('/hrdats/mt/form', 'MasterTableController@indexForm')->name('mt.form');
//--SIM--
Route::get('/hrdats/mt/show/sim', 'MasterTableController@ShowSim')->name('mt.showSim');

//Master Table Vendor
Route::get('/hrdats/mt/vendor', 'MasterTableController@indexVendor')->name('mt.vendor');
