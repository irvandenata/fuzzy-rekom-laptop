<?php

use App\Http\Controllers\Admin\MasterProductController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
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

Route::get('/form', [App\Http\Controllers\FuzzyController::class, 'form'])->name('form');
Route::post('/fuzzy', [App\Http\Controllers\FuzzyController::class, 'index'])->name('fuzzy');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('admin')->group(function () {
    Route::resource('user', UserController::class);
    Route::resource('transaction', TransactionController::class);

    Route::prefix('master-data')->group(function () {
        Route::resource('product', MasterProductController::class);
    });
});
