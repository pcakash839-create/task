<?php

use Illuminate\Support\Facades\Route;
use App\Models\CartItemModel;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function(){
        return view ('admin.home');
    });
    Route::resource('product',\App\Http\Controllers\ProductController::class);

    Route::get('/cart-items',function(){
    $data = CartItemModel::all()->toArray();
    return view('admin.cart_item',compact('data'));
});
});

Route::get('/home',function(){
    return view('home');
});
