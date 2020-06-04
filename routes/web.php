<?php

use Illuminate\Support\Facades\Route;
use Redirect;

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

Route::get('/profile','ProfilesController@index');
Route::get('/profile/edit','ProfilesController@edit');
Route::post('/profile/edit','ProfilesController@update');
Route::get('/profile/delete','ProfilesController@delete');
Route::post('/profile/delete','ProfilesController@destroy');
