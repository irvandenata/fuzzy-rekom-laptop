<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);

Route::get('/product', [ProductController::class, 'all']);

Route::middleware('auth:sanctum')->group(function () {
Route::post('/logout', [UserController::class, 'logout']);
Route::get('/fetch-user', [UserController::class, 'fetch']);
Route::post('/checkout', [TransactionController::class, 'checkout']);
Route::get('/transaction', [TransactionController::class, 'all']);

});
