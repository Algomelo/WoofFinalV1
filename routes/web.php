<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Middleware\AdminMiddleware;

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



// Rutas protegidas para adiminsitrador solo acceso admin

Route::middleware('admin')->group(function () {
    Route::get('/blogs/create', [BlogController::class, 'showForm']); // Mostrar formulario de creación de blog
    Route::post('/agregar_blog', [BlogController::class, 'store'])->name('blog.store'); // Almacenar el nuevo blog
    Route::get('/blogs/{id}/edit', [BlogController::class, 'showEditForm']); // Mostrar formulario de edición
    Route::put('/blogs/{id}', [BlogController::class, 'update']); // Actualizar el blog existente
});


// Ruta para mostrar los detalles del blog
Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.show');



Route::get('/blog-single', function () {
    return view('blog-single');
});
Route::get('/blog', function () {
    return view('blog');
});



Route::get('/', function () {
    return view('index');
});

Route::get('/products', function () {
    return view('products');
});

Route::get('/gallery', function () {
    return view('gallery');
});


Route::get('/about', function () {
    return view('about');
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



Route::resource('blogs','App\Http\Controllers\BlogController');


});


