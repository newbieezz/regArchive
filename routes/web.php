<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Main\UserController;
use App\Models\Course;
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
        // Enrollment routes
        Route::get('student/enrollment', 'EnrollmentRecordsController@index');
        Route::get('student/create', 'EnrollmentRecordsController@create');
        Route::get('/update/{id}', 'EnrollmentRecordsController@edit');
        Route::post('/update/{id}', 'EnrollmentRecordsController@update');
        // Graduating Applicants routes
        Route::get('graduating/applicants', 'GraduatingApplicantsController@index');
        Route::get('documents/records', 'DocumentsController@index');
    });
    Route::namespace('App\Http\Controllers\Settings')->group(function(){
        Route::prefix('settings')->group(function () {
            // Account routes
            Route::prefix('user')->group(function () {
                Route::get('/', 'AccountController@index');
                Route::get('/create', 'AccountController@create');
                Route::post('/store', 'AccountController@store');
                Route::get('/update/{id}', 'AccountController@edit');
                Route::post('/update/{id}', 'AccountController@update');
                Route::get('/activate/{id}', 'AccountController@activate');
                Route::get('/deactivate/{id}', 'AccountController@deactivate');
            });
            // Department routes
            Route::prefix('department')->group(function () {
                Route::get('/', 'DepartmentController@index');
                Route::get('/create', 'DepartmentController@create');
                Route::post('/store', 'DepartmentController@store');
                Route::get('/update/{id}', 'DepartmentController@edit');
                Route::post('/update/{id}', 'DepartmentController@update');
            });
            // Course routes
            Route::prefix('course')->group(function () {
                Route::get('/', 'CourseController@index');
                Route::get('/create', 'CourseController@create');
                Route::post('/store', 'CourseController@store');
                Route::get('/update/{id}', 'CourseController@edit');
                Route::post('/update/{id}', 'CourseController@update');
            });
            // Course MAjor routes
            Route::prefix('major')->group(function () {
                Route::get('/{id}', 'CourseMajorController@index');
                Route::match(['get','post'],'/create/{id}', 'CourseMajorController@create');
                Route::match(['get','post'],'/store/{id}', 'CourseMajorController@store');
                Route::get('/update/{id}', 'CourseMajorController@edit');
                Route::post('/update/{id}', 'CourseMajorController@update');
            });
            //Requirements category routes
            Route::prefix('requirement')->group(function () {
                Route::get('/', 'RequirementController@index');
                Route::get('/create', 'RequirementController@create');
                Route::post('/store', 'RequirementController@store');
                Route::get('/update/{id}', 'RequirementController@edit');
                Route::post('/update/{id}', 'RequirementController@update');
            });
            //Trash routes
            Route::prefix('trash')->group(function () {
                Route::get('/', 'TrashController@index');
            });
        });
    });
});
