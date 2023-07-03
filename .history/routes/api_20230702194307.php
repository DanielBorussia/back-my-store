<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
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

Route::apiResource('/products', ProductsController::class);
Route::apiResource('/users', UsersController::class);
Route::post('/auth', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function() {
    Route::apiResource('/orders', OrdersController::class);
    Route::get('/auth/logout', [AuthController::class, 'logout']);
});