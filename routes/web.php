<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[WebController::class,'index'])->name('index');
Route::get('{product}/details',[WebController::class,'details'])->name('details');
Route::get('cart',[WebController::class,'cart'])->name('cart');
Route::get('listing/{gender}',[WebController::class,'listing'])->name('listing');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('comment/store', [CommentController::class, 'store'])->name('storeComment');
    Route::get('remove/{cart}',[CartController::class, 'removeIndex'])->name('removeIndex');
    Route::post('add/cart',[CartController::class, 'addCart'])->name('addCart');
    Route::get('checkout',[CartController::class, 'checkout'])->name('checkout');
});



//check role
Route::middleware(['auth:sanctum'])->group(function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('products', [AdminController::class, 'products'])->name('products');
        Route::get('products/create', [AdminController::class, 'createProducts'])->name('createProducts');
        Route::post('products/store', [AdminController::class, 'storeProducts'])->name('storeProducts');
        Route::get('products/show/{product}', [AdminController::class, 'showProduct'])->name('showProduct');
        Route::get('comment/moderate', [CommentController::class, 'moderate'])->name('moderate');
        Route::get('active/{comment}', [CommentController::class, 'active'])->name('active');
        Route::get('inactive/{comment}', [CommentController::class, 'inactive'])->name('inactive');
        Route::patch('delete/{comment}', [CommentController::class, 'destroy'])->name('destroyComment');
        Route::get('user/all', [AdminController::class, 'user'])->name('user');
        Route::get('create/user', [AdminController::class, 'createUser'])->name('createUser');
        Route::post('store/user', [AdminController::class, 'storeUser'])->name('storeUser');
        Route::patch('delete/{user}', [AdminController::class, 'destroy'])->name('destroy');
        Route::get('sales', [AdminController::class, 'sales'])->name('sales');

    });
});


Route::middleware(['auth:sanctum'])->group(function () {
    Route::group(['prefix' => 'sales', 'as' => 'sales.'], function () {
Route::get('/',[SalesController::class,'index'])->name('sales');
Route::post('store',[SalesController::class,'store'])->name('store');

    });
});


Route::middleware(['auth:sanctum'])->group(function () {
    Route::group(['prefix' => 'customer', 'as' => 'customer.'], function () {
        Route::get('/',[CustomerController::class,'index'])->name('index');
        Route::get('add/order',[CustomerController::class,'addOrder'])->name('addOrder');

    });
});


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
