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

Auth::routes();
Route::namespace('App\Http\Controllers\Front')->group(function(){
    Route::get('/','UserController@login');
    Route::match(['get','post'],'ulogin','UserController@ulogin');
     //protected routes/ needs to login first before user can open
    Route::group(['middleware' => ['auth']], function() {
    Route::match(['get','post'],'dashboard', 'UserController@dashboard');
    Route::match(['get','post'],'add','UserController@addAccount');
    Route::get('users','UserController@users');
    Route::get('logout','UserController@logout');
    Route::get('studRecords','StudentsRecordController@view');
    Route::get('collegeDept','CollegeDeptController@view');
    Route::get('gradApplicants','GraduationRecordController@view');
    Route::get('enrollmentRec','EnrollmentRecordController@view');
    Route::get('categories','CategoryController@view');
    Route::get('trash','TrashController@view');
    Route::match(['get','post'],'addCategory','UserController@addCategory');
    
    });
});
