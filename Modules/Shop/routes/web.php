<?php

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

use Illuminate\Support\Facades\Route;
use Modules\Shop\Http\Controllers\CartController;
use Modules\Shop\Http\Controllers\ProductController;
use Modules\Shop\Http\Controllers\OrderController;
use Modules\Shop\Http\Controllers\PaymentController;

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/category/{categorySlug}', [ProductController::class, 'category'])->name('products.category');




Route::get('/{categorySlug}/{productSlug}', [ProductController::class, 'show'])->name('products.show');