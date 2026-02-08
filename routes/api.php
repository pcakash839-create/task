<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\ProductModel;
use App\Models\CartItemModel;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Example route
Route::get('/products', function(){
    $data = ProductModel::all();
    return response()->json(['status' => true,'data' => $data]);
});


Route::post('/add_to_cart',function(Request $reqs){
    CartItemModel::create([
        'name' => $reqs->name,
        'price' => $reqs->price
    ]);
return response()->json(['status' => true,'data' => "added to cart"]);
});

Route::post('/delete_from_cart',function(Request $reqs){
    $data = CartItemModel::find($reqs->id);
    $data->delete();
    return response()->json(['status' => true,'data' => "deleted from cart"]);
});

Route::get('/cart_items',function(){
    $data = CartItemModel::all();
    return response()->json(['status' => true,'data' => $data]);
});