<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\FrontProductController;

// for testing purposely
use App\Models\Section;
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



// Route::get('/test', function(){
//     $sections = Section::with(['categories' => function($query){
//         $query->with(['subcategories' => function($query2){
//             $query2->where(['status' => 1]);
//         }])
//         ->where(['status' => 1, 'parent_id' => 0]);
//     }])->where('status', 1)->get();
//     $sections = json_decode(json_encode($sections));
//     echo "<pre>"; print_r($sections); die;
// });

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

        // Brand Routes
        Route::get('brands', [BrandController::class, 'brands']);
        Route::match(['get', 'post'],'brand/add', [BrandController::class, 'addBrand']);
        Route::match(['get', 'post'], 'brand/update/{id}', [BrandController::class, 'updateBrand']);
        Route::post('brand/delete', [BrandController::class, 'deleteBrand']);

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

        // Product Attributes
        Route::match(['get', 'post'], '/product/attributes/{id}', [ProductController::class, 'productAttributes']);
        Route::post('product/attributes/update/{id}', [ProductController::class, 'updateProductAttributes']);
        Route::post('product/attributes/delete/{id}', [ProductController::class, 'deleteProductAttributes']);
        Route::post('product/attribute/change-attribute-status/', [ProductController::class, 'changeProductAttributeStatus']);
        Route::post('product/attribute/delete', [ProductController::class, 'deleteProductAttributes']);

        // Product Images
        Route::match(['get', 'post'], '/product/images/{id}', [ProductController::class, 'productImages']);
        // Route::post('product/attributes/update/{id}', [ProductController::class, 'updateProductAttributes']);
        // Route::post('product/image/delete/{id}', [ProductController::class, 'deleteProductAttributes']);
        Route::post('product/image/change-image-status/', [ProductController::class, 'changeProductImageStatus']);
        Route::post('product/image/delete', [ProductController::class, 'deleteProductImages']);
    });
});

Route::group(['namespace' => 'Front'], function(){
    Route::get('/', [FrontController::class, 'index']);
    Route::get('/{url}', [FrontProductController::class, 'listing']);
});
