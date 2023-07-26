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


// Ruta de Servicios
Route::get('/services', [App\Http\Controllers\ServicesController::class, 'index']);
Route::get('/services/create', [App\Http\Controllers\ServicesController::class, 'create']);
Route::get('/services/{service}/edit', [App\Http\Controllers\ServicesController::class, 'edit']);
Route::post('/services', [App\Http\Controllers\ServicesController::class, 'sendData']);
Route::put('/services/{service}', [App\Http\Controllers\ServicesController::class, 'update']);
Route::delete('/services/{service}', [App\Http\Controllers\ServicesController::class, 'destroy']);


//Ruta Paseadores
Route::resource('walkers','App\Http\Controllers\WalkerController');

// Ruta Usuarios

Route::resource('users','App\Http\Controllers\UserController');