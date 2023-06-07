<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::get('/categories',[CategoryController::class,'getAllCategories'])->middleware('cors');
Route::get('/featuredproducts',[ProductController::class,'featureProducts'])->middleware('cors');
Route::get('/category-products/{category}', [ProductController::class, 'getProductsByCategory'])->middleware('cors');
Route::get('/pp',[ProductController::class,'paginatedProducts'])->middleware('cors');
Route::get('/products/{id}', [ProductController::class, 'getProductById'])->middleware('cors');
Route::post('/order', [OrderController::class, 'store'])->middleware('auth:sanctum');

Route::controller(AuthController::class)->group(function(){

    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
