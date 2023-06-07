<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
// Route::get('/home', function () {
//     return view('index');
// });
// Route::get('/electronic', function () {
//     return view('electronic');
// });
// Route::get('/all-products', function () {
//     return view('allproducts');
// });
// Route::get('/cart', function () {
//     return view('cart');
// });
// Route::get('categories/{categoryName}', function ($categoryName) {
//     return view('category', ['categoryName' => $categoryName]);
// });
