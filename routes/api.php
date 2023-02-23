<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('products', ProductController::class)
    ->missing(function () {
        return model_binding_error_response();
    });

Route::resource('categories', CategoryController::class)
    ->missing(function () {
        return model_binding_error_response();
    });
    
Route::group(['prefix' => 'orders/{order}'], function () {
    Route::post('/purchase', [OrderController::class, 'purchase'])
        ->missing(function () {
            return model_binding_error_response();
        });
    Route::post('/cancel', [OrderController::class, 'cancel'])
        ->missing(function () {
            return model_binding_error_response();
        });
});

