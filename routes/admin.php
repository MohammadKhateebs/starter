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



Route::namespace("Admin")->group(function (){
    Route::get("admin","AdminController@showAdminName");
}
);
Route::group(['namespace'=>'Admin'],function (){
    Route::get("showname","SecondController@getName");

});

