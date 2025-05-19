<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function() {
        Route::post('register', [UserController::class, 'store']);
        Route::Post('logout', [AuthController::class, 'logout']);
        Route::get('listProduct', [ProductController::class, 'index']);
Route::middleware('role:admin')->group(function () {
        Route::apiResource('product', ProductController::class);
        Route::apiResource('category', CategoryController::class);
   });
});
