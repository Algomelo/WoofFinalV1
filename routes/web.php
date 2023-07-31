<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'admin'])->group(function () {

    // Ruta de Servicios
Route::get('/services', [App\Http\Controllers\admin\ServicesController::class, 'index']);
Route::get('/services/create', [App\Http\Controllers\admin\ServicesController::class, 'create']);
Route::get('/services/{service}/edit', [App\Http\Controllers\admin\ServicesController::class, 'edit']);
Route::post('/services', [App\Http\Controllers\admin\ServicesController::class, 'sendData']);
Route::put('/services/{service}', [App\Http\Controllers\admin\ServicesController::class, 'update']);
Route::delete('/services/{service}', [App\Http\Controllers\admin\ServicesController::class, 'destroy']);

    // Ruta de Paquetes
    Route::get('/packages', [App\Http\Controllers\admin\PackageController::class, 'index']);
    Route::get('/packages/create', [App\Http\Controllers\admin\PackageController::class, 'create']);
    Route::get('/packages/{package}/edit', [App\Http\Controllers\admin\PackageController::class, 'edit']);
    Route::post('/packages', [App\Http\Controllers\admin\PackageController::class, 'store']);
    Route::put('/packages/{package}', [App\Http\Controllers\admin\PackageController::class, 'update']);
    Route::delete('/packages/{package}', [App\Http\Controllers\admin\PackageController::class, 'destroy']);

//Ruta Paseadores
Route::resource('walkers','App\Http\Controllers\admin\WalkerController');

// Ruta Usuarios

Route::resource('users','App\Http\Controllers\admin\UserController');


    
});


