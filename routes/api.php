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

Route::group(["middleware" => "apikey.validate"], function () {
    Route::post("store", "ProductsController@store")->name('store');
    Route::post("destroy", "ProductsController@destroy")->name('destroy');
    Route::post("update", "ProductsController@update")->name('update');
    Route::post("create", "ProductsController@create")->name('create');
    Route::post("invoicePDF", "ProductsController@invoicePDF")->name('invoicePDF');

});

