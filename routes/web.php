<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\CategoryController; //Custom Import
use App\Http\Controllers\SubcategoryController; //Custom Import
use App\Http\Controllers\ProductController; //Custom Import
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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'verified'])->group(function () {

    /* Categories - Start */
    Route::get('/create/category', [CategoryController::class, 'create'])->name('create.category'); //Form: Create Category
    Route::post('/store/category', [CategoryController::class, 'store'])->name('store.category'); //Category Insert

    Route::get('categories', [CategoryController::class, 'index'])->name('categories'); //Fetch all categories
    Route::delete('remove/category/{id}', [CategoryController::class, 'destroy'])->name('remove.category'); //Category remove

    Route::get('edit/category/{id}', [CategoryController::class, 'edit'])->name('edit.category'); //Form: Edit Category
    Route::put('update/category/{id}', [CategoryController::class, 'update'])->name('update.category'); //Category Update
    /* Categories - End */

    /* SubCategories - Start */
    Route::get('/create/subcategory', [SubcategoryController::class, 'create'])->name('create.subcategory'); //Form: Create SubCategory
    Route::post('/store/subcategory', [SubcategoryController::class, 'store'])->name('store.subcategory'); //SubCategory Insert

    Route::get('subcategories', [SubcategoryController::class, 'index'])->name('subcategories'); //Fetch all subcategories
    Route::delete('remove/subcategory/{id}', [SubcategoryController::class, 'destroy'])->name('remove.subcategory'); //SubCategory remove

    Route::get('edit/subcategory/{subcategoryid}', [SubcategoryController::class, 'edit'])->name('edit.subcategory'); //Form: Edit SubCategory
    Route::put('update/subcategory/{id}', [SubcategoryController::class, 'update'])->name('update.subcategory'); //SubCategory Update
    /* SubCategories - End */

    /* Products - Start */
    Route::get('/create/product/{category_id?}', [ProductController::class, 'create'])->name('create.product'); //Form: Create Product
    Route::post('/store/product', [ProductController::class, 'store'])->name('store.product'); //Product Insert

    Route::get('products', [ProductController::class, 'index'])->name('products'); //Fetch all Products
    Route::delete('remove/product/{id}', [ProductController::class, 'destroy'])->name('remove.product'); //Product remove

    Route::get('edit/product/{product_id}/{category_id}', [ProductController::class, 'edit'])->name('edit.product'); //Form: Edit Product
    Route::put('update/product', [ProductController::class, 'update'])->name('update.product'); //Product Update
    /* Products - End */
});


require __DIR__ . '/auth.php';
