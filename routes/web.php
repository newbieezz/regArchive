<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Main\UserController;
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

Route::prefix('user')->group(function () {
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/logout', [LoginController::class, 'logout']);
});

Route::get('/', [UserController::class, 'index']);

Route::group(['middleware' => ['auth']], function() {
    Route::namespace('App\Http\Controllers\Main')->group(function(){
        Route::get('dashboard', 'HomeController@index');
        Route::get('student/records', 'StudentRecordsController@index');
        Route::get('student/enrollment', 'EnrollmentRecordsController@index');
        Route::get('graduating/applicants', 'GraduatingApplicantsController@index');
        Route::get('documents/records', 'DocumentsController@index');
    });
    Route::namespace('App\Http\Controllers\Settings')->group(function(){
        Route::prefix('settings')->group(function () {
            // Account routes
            Route::prefix('user')->group(function () {
                Route::get('/', 'AccountController@index');
                Route::get('/create', 'AccountController@create');
                Route::get('/update/{id?}', 'AccountController@edit');
                Route::get('/delete', 'AccountController@destroy');
            });
            // Department routes
            Route::prefix('department')->group(function () {
                Route::get('/', 'DepartmentController@index');
            });
            // Course routes
            Route::prefix('course')->group(function () {
                Route::get('/', 'CourseController@index');
            });
            // Course MAjor routes
            Route::prefix('major')->group(function () {
                Route::get('/', 'CourseMajorController@index');
            });
            //Requirements category routes
            Route::prefix('requirement')->group(function () {
                Route::get('/', 'RequirementController@index');
            });
            //Requirements category routes
            Route::prefix('trash')->group(function () {
                Route::get('/', 'TrashController@index');
            });
        });
    });
});
