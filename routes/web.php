<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Auth::routes();
Route::namespace('App\Http\Controllers\Front')->group(function(){
    Route::match(['get','post'],'ulogin','UserController@login');
     //protected routes/ needs to login first before user can open
    Route::group(['middleware'=>['auth']],function(){
    Route::match(['get','post'],'dashboard', 'UserController@dashboard');
    });
});
