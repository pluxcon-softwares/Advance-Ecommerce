<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
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
        Route::match(['get', 'post'], '/section/add', [SectionController::class, 'addSection']);

        //Category Route
        Route::get('categories', [CategoryController::class, 'categories']);
        Route::post('category/change-category-status', [CategoryController::class, 'changeSectionStatus']);
        Route::match(['get','post'],'category/add', [CategoryController::class, 'addCategory']);
        Route::post('fetch/section/categories', [CategoryController::class, 'fetchSectionCategories']);
        Route::match(['get', 'post'], 'category/update/{id?}', [CategoryController::class, 'updateCategory']);
        Route::post('category/delete', [CategoryController::class, 'deleteCategory']);

        // Product Route
        Route::get('products', [ProductController::class, 'products']);
        Route::post('product/view', [ProductController::class, 'viewProduct']);
        Route::post('product/change-product-status', [ProductController::class, 'changeProductStatus']);
        Route::match(['get', 'post'],'product/add', [ProductController::class, 'addProduct']);
        Route::match(['get', 'post'],'product/update/{id?}', [ProductController::class, 'updateProduct']);
        Route::post('product/delete', [ProductController::class, 'deleteProduct']);
    });
});
