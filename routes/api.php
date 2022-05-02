<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\StockController;
use App\Http\Controllers\API\CardItemController;
use App\Http\Controllers\API\OrderController;

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

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);
   
Route::middleware('auth:api')->group( function () {
    Route::resource('products', ProductController::class);
    Route::resource('stocks', StockController::class);
    Route::resource('card-items', CardItemController::class);
    Route::resource('orders', OrderController::class);
    Route::get('/me', function(){
        $user = Auth::user();
        return response()->json($user,200);
      });
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
