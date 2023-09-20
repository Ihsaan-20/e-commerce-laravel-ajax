<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\TempImageController;
use App\Http\Controllers\admin\subCategoryController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ProductSubCategoryController;
use App\Http\Controllers\admin\ProductImageController;

use App\Http\Controllers\FrontController;
use App\Http\Controllers\ShopController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;


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
// FrontController Route;
Route::get('/',[FrontController::class,'home'])->name('front.home');

// ShopController Route;
// Route::get('/shop',[ShopController::class,'index'])->name('front.shop');
Route::get('/shop/{categorySlug?}/{subCategorySlug?}',[ShopController::class,'index'])->name('front.shop');
Route::get('/productslug/{slug}/',[ShopController::class,'productslug'])->name('front.slug');



// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

// Admin  middleware routes;
Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // // Category Routes;
    Route::get('/category/index',[CategoryController::class,'index'])->name('admin.category.index');
    Route::get('/category/create',[CategoryController::class,'create'])->name('admin.category.create');
    Route::post('/category/store',[CategoryController::class,'store'])->name('admin.category.store');
    Route::get('/category/{id}/edit',[CategoryController::class,'edit'])->name('admin.category.edit');
    Route::put('/category/{id}/update',[CategoryController::class,'update'])->name('admin.category.update');
    Route::delete('/category/{id}/delete',[CategoryController::class,'destory'])->name('admin.category.delete');

    // // Sub-Category Routes;
    Route::get('/sub-category/index',[subCategoryController::class,'index'])->name('sub-category.index');
    Route::get('/sub-category/create',[subCategoryController::class,'create'])->name('sub-category.create');
    Route::post('/sub-category/store',[subCategoryController::class,'store'])->name('sub-category.store');
    Route::get('/sub-category/{id}/edit',[subCategoryController::class,'edit'])->name('sub-category.edit');
    Route::put('/sub-category/{id}/update',[subCategoryController::class,'update'])->name('sub-category.update');
    Route::delete('/sub-category/{id}/delete',[subCategoryController::class,'destory'])->name('sub-category.delete');

    // // Brand Routes;
    Route::get('/brand/index',[BrandController::class,'index'])->name('brand.index');
    Route::get('/brand/create',[BrandController::class,'create'])->name('brand.create');
    Route::post('/brand/store',[BrandController::class,'store'])->name('brand.store');
    Route::get('/brand/{id}/edit',[BrandController::class,'edit'])->name('brand.edit');
    Route::put('/brand/{id}/update',[BrandController::class,'update'])->name('brand.update');
    Route::delete('/brand/{id}/delete',[BrandController::class,'destory'])->name('brand.delete');

    // // slug Routes;
    Route::get('/product/index',[ProductController::class,'index'])->name('product.index');
    Route::get('/product/create',[ProductController::class,'create'])->name('product.create');
    Route::post('/product/store',[ProductController::class,'store'])->name('product.store');
    Route::get('/product/{id}/edit',[ProductController::class,'edit'])->name('product.edit');
    Route::put('/product/{id}/update',[ProductController::class,'update'])->name('product.update');
    Route::delete('/product/{id}/delete',[ProductController::class,'destory'])->name('product.destory');

    // // Get Sub categories throug ajax route;
    Route::get('/product-sub-category/index',[ProductSubCategoryController::class,'index'])->name('product-sub-category.index');



    // // TempNameController
    Route::post('/temp/image',[TempImageController::class, 'create'])->name('temp-images.create');

    // // ProdcutImageController;
    Route::post('/product/images/update',[ProductImageController::class, 'update'])->name('product-images.update');
    Route::delete('/product/images',[ProductImageController::class,'destory'])->name('product-images.delete');

        // slug genetor function route;
        Route::get('/getSlug', function(Request $request){
            $slug = '';
            if( !empty($request->title)){
                $slug = Str::slug($request->title);
            }
            return response()->json([
                'status' => true,
                'slug' => $slug
            ]);
        })->name('getSlug');//route end;

});//admin middleware



// // User middleware Routes;
// Route::middleware('auth','role:user')->group(function () {
//     Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
// });