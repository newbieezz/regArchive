<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Main\UserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
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

Route::get('/', [UserController::class, 'index'])->name('login');

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::group(['middleware' => ['auth']], function() {
    Route::namespace('App\Http\Controllers\Main')->group(function(){
        Route::get('dashboard', 'HomeController@index');
        Route::get('/checkNewEntry', 'HomeController@checkNewEntry');
        Route::get('/checkPrevEntry', 'HomeController@checkPrevEntry');
        Route::post('/storeActivityLog', 'HomeController@storeActivityLog');
        Route::post('/storeStudentsLog', 'HomeController@storeStudentsLog');
        Route::get('/update/{id}', 'HomeController@editprofile');
        Route::post('/update/{id}', 'HomeController@updateprofile');
        // Students routes
        Route::prefix('student')->group(function () {
            Route::get('/records', 'StudentRecordsController@index');
            Route::get('/records/{status}', 'StudentRecordsController@index');
            Route::get('/show/{id}', 'StudentRecordsController@show');
        });
        
        // Enrollment routesphp 
        Route::prefix('enrollment')->group(function () {
            Route::get('/create', 'EnrollmentRecordsController@create');
            Route::post('/store', 'EnrollmentRecordsController@store');
            Route::get('/update/{id}', 'EnrollmentRecordsController@edit');
            Route::post('/update/{id}', 'EnrollmentRecordsController@update');
            Route::get('/show/{id}', 'EnrollmentRecordsController@show');
            Route::get('/import', 'EnrollmentRecordsController@import');
            Route::get('/import', 'EnrollmentRecordsController@import');
            Route::get('/export', 'EnrollmentRecordsController@export_data');
            Route::post('/upload', 'EnrollmentRecordsController@upload');
            Route::get('/', 'EnrollmentRecordsController@index');
            Route::get('/{status}', 'EnrollmentRecordsController@index');
        });
        // Graduating Applicants routes
        Route::get('graduating/applicants', 'GraduatingApplicantsController@index');

        // Documents routes
        Route::prefix('documents')->group(function () {
            Route::get('/records', 'DocumentsController@index');
            Route::get('/records/{status}', 'DocumentsController@index');
            Route::get('/upload/{studentId}', 'DocumentsController@create');
            Route::post('/upload/{studentId}', 'DocumentsController@store');
            Route::get('/trash', 'TrashController@index');
            Route::get('/trash/restore', 'TrashController@restore');
            Route::get('/trash/delete', 'TrashController@delete');
            Route::get('/transactions', 'DocumentsController@transactions')->middleware('admin_only');
            Route::get('/download/{studentId}', 'DocumentsController@download');
        });
        

        // User Profile routes
        Route::prefix('profile')->group(function () {
            
        });
    });
    Route::namespace('App\Http\Controllers\Settings')->middleware('admin_only')->group(function(){
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
            ;
            // Department routes
            Route::prefix('department')->group(function () {
                Route::get('/', 'DepartmentController@index');
                Route::get('/create', 'DepartmentController@create');
                Route::post('/store', 'DepartmentController@store');
                Route::get('/update/{id}', 'DepartmentController@edit');
                Route::post('/update/{id}', 'DepartmentController@update');
                Route::get('/delete/{id}', 'DepartmentController@destroy');
            });
            // Course routes
            Route::prefix('course')->group(function () {
                Route::get('/', 'CourseController@index');
                Route::get('/create', 'CourseController@create');
                Route::post('/store', 'CourseController@store');
                Route::get('/update/{id}', 'CourseController@edit');
                Route::post('/update/{id}', 'CourseController@update');
                Route::get('/delete/{id}', 'CourseController@destroy');
            });
            // Course MAjor routes
            Route::prefix('major')->group(function () {
                Route::get('/{id}', 'CourseMajorController@index');
                Route::match(['get','post'],'/create/{id}', 'CourseMajorController@create');
                Route::match(['get','post'],'/store/{id}', 'CourseMajorController@store');
                Route::get('/update/{id}', 'CourseMajorController@edit');
                Route::post('/update/{id}', 'CourseMajorController@update');
                Route::get('/delete/{id}', 'CourseMajorController@destroy');
            });
            //Requirements category routes
            Route::prefix('requirement')->group(function () {
                Route::get('/', 'RequirementController@index');
                Route::get('/create', 'RequirementController@create');
                Route::post('/store', 'RequirementController@store');
                Route::get('/update/{id}', 'RequirementController@edit');
                Route::post('/update/{id}', 'RequirementController@update');
                Route::get('/delete/{id}', 'RequirementController@destroy');
            });
            // School Year routes
            Route::prefix('schoolyear')->group(function () {
                Route::get('/', 'SchoolYearController@index');
                Route::post('/store', 'SchoolYearController@store');
                Route::get('/update/{id}', 'SchoolYearController@edit');
                Route::post('/update/{id}', 'SchoolYearController@update');
                Route::get('/delete/{id}', 'SchoolYearController@destroy');
            });
            // Class Section routes
            Route::prefix('section')->group(function () {
                Route::get('/', 'SectionController@index');
                Route::post('/store', 'SectionController@store');
                Route::get('/update/{id}', 'SectionController@edit');
                Route::post('/update/{id}', 'SectionController@update');
                Route::get('/delete/{id}', 'SectionController@destroy');
            });
            // Document Transaction routes
            Route::prefix('transaction')->group(function () {
            });
        });
    });
    Route::namespace('App\Http\Controllers\Settings')->group(function(){
        Route::prefix('api')->group(function () {
            Route::get('/courses/{departmentId}', 'CourseController@getCouresByDepartment');
            Route::get('/majors/{courseId}', 'CourseMajorController@getMajorsByCourse');
            Route::get('/student/{studentId}', 'StudentRecordsController@getSudentById');
        });
    });
    Route::namespace('App\Http\Controllers\Main')->group(function(){
        Route::prefix('api')->group(function () {
            Route::get('/student/{studentId}', 'StudentRecordsController@getSudentById');
        });
    });
});
