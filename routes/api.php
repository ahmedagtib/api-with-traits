<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::group(['middleware'=>['api','checkpassword','lang'],'namespace'=>'api'],function(){

  Route::post('/category/{id}','ApiController@getcategory');
  Route::post('login','ApiController@dologin');

});

Route::group(['middleware'=>['api','checkpassword','lang','checkadmintoken:admin-api'],'namespace'=>'api'],function(){

 Route::post('/categories','ApiController@getcategories');


});	


