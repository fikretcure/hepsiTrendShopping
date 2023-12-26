<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::apiResource('products', ProductController::class);
Route::apiResource('categories', CategoryController::class);

Route::prefix('basket')->controller(OrderController::class)->group(function () {
    Route::get('', 'basket')->name('basket');
    Route::put('increasing-quantity-product', 'increasingQuantityProduct')->name('increasingQuantityProduct');
    Route::put('decrement-quantity-product', 'decrementQuantityProduct')->name('decrementQuantityProduct');
    Route::delete('remove-product', 'removeProduct')->name('removeProduct');
    Route::post('payment', 'payment')->name('payment');
});
Route::put('order-items/change-succesful/{id}', [OrderController::class, 'changeSuccesful']);

Route::apiResource('orders', OrderController::class);
Route::post('upload', [FileController::class, 'upload']);
