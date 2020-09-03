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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::get("todo","Todocontroller@index");
// Route::post("todo/{todo}","Todocontroller@store");
// Route::get("todo/{todo}","Todocontroller@show");
// Route::put("todo/{todo}","Todocontroller@update");
// Route::delete("todo/{todo}","Todocontroller@delete");

Route::get("todo","Todocontroller@index");
Route::post("todo","Todocontroller@store");
Route::get("todo/{id}","Todocontroller@show");
Route::put("todo/{id}","Todocontroller@update");
Route::delete("todo/{id}","Todocontroller@destroy");