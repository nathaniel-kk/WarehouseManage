<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('auth')->namespace('Auth')->group(function () {
    Route::post('login', 'AuthController@login'); //普通登陆
    Route::post('adminlogin', 'AuthController@adminLogin'); //超级管理员登陆
    Route::post('logout', 'AuthController@logout'); //退出登陆
    Route::post('refresh', 'AuthController@refresh'); //刷新token
    Route::post('register', 'AuthController@registered'); //注册接口
});

Route::prefix('lowadmin')->namespace('LowAdmin')->group(function () {
    Route::post('writeshipment','ShipmentController@writeShipment');
    Route::post('writeinventory','InventoryController@writeInventory');

    Route::get('getform','FormController@getForm');
  //  Route::get('deleterecode','FormController@deleteRecode');
    Route::get('checkrecode','FormController@checkRecode');

    Route::get('getcargo','CargoController@getCargo');
    Route::get('checkcargo','CargoController@checkCargo');
    Route::get('updatetype','CargoController@updateType');
});


