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
    
    if(Auth::check()){
        return Redirect('/vehicle');
    }else{
        return view('home');
    }

});

Auth::routes(['verify' => true]);

Route::get('/vehicle','VehiclesController@index')->middleware('verified');
Route::get('/vehicle/add','VehiclesController@add');
Route::post('/vehicle/register','VehiclesController@register');
Route::get('/vehicle/{vehicle}','VehiclesController@edit');
Route::post('/vehicle/{vehicle}','VehiclesController@update');


Route::get('/profile','ProfilesController@index');
Route::get('/profile/edit','ProfilesController@edit');
Route::post('/profile/edit','ProfilesController@update');
Route::get('/profile/delete','ProfilesController@delete');
Route::post('/profile/delete','ProfilesController@destroy');

Route::get('/service','ServicesController@index');
Route::get('/service/add','ServicesController@add');
Route::post('/service/request','ServicesController@request');
Route::get('/service/{service}','ServicesController@edit');
Route::post('/service/{service}','ServicesController@update');
