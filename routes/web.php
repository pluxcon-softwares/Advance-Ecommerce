<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Admin\SectionController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'admin'], function(){
    Route::get('/', [AdminController::class, 'login']);
    Route::post('/', [AdminController::class, 'authenticate']);

    Route::group(['middleware'=>['checkadmin']], function(){
        Route::get('logout', [AdminController::class, 'logout']);
        Route::get('/dashboard', [DashboardController::class, 'dashboard']);
        Route::get('update-admin-password', [DashboardController::class, 'updateAdminPasswordForm']);
        Route::post('update-admin-password', [DashboardController::class, 'updateAdminPassword']);
        Route::post('check-current-password', [DashboardController::class, 'checkCurrentPassword']);
        Route::match(['get', 'post'], 'update-admin-details', [DashboardController::class, 'updateAdminDetails']);

        //Section Route
        Route::get('sections', [SectionController::class, 'sections']);
        Route::post('section/change-section-status', [SectionController::class,'changeSectionStatus']);
    });
});
