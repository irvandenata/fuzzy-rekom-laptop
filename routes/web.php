<?php

use App\Http\Controllers\Admin\MasterKecamatanController;
use App\Http\Controllers\Admin\MasterKelurahanController;
use App\Http\Controllers\Admin\MasterKotaController;
use App\Http\Controllers\Admin\PasienController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('admin')->group(function () {
    Route::resource('user', UserController::class);
    Route::prefix('master-data')->group(function () {
        Route::resource('kota', MasterKotaController::class);
        Route::resource('kecamatan', MasterKecamatanController::class);
        Route::resource('kelurahan', MasterKelurahanController::class);
    });

});
Route::middleware('auth')->group(function () {
    Route::resource('pasien', PasienController::class);
});

