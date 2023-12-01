<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ContactForm;
use App\Http\Controllers\ContactJobController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentMail;
use App\Mail\LandignMail;
use App\Mail\Enviarcorreo;
use App\Mail\EnviarcorreoJob;

//Rutas Envio Correo

Route::post('/confirm-appointment', [AppointmentController::class, 'confirmAppointment'])->name('confirm.appointment');
Route::post('/confirm-landing', [LandingController::class, 'confirmLanding'])->name('confirm.landing');
Route::post('/confirm-contactt', [ContactForm::class, 'EnviarCorreoContact'])->name('confirm.contactt');
Route::post('/confirm-contacjob', [ContactJobController::class, 'EnviarContactJob'])->name('confirm.contacjob');
 

// Ruta para mostrar los detalles del blog
Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/landing', function () {
    return view('landing');
});

Route::get('/', function () {
    return view('index');
});

Route::get('/home', function () {
    return view('index');
});
Route::get('/index', function () {
    return view('index');
});
Route::get('/services', function () {
    return view('services2');
});

Route::get('/gallery', function () {
    return view('gallery');
});

Route::get('/aboutus', function () {
    return view('aboutus');
});


Route::get('/contactusers', function () {
    return view('contactusers');
});


Route::get('/contactjob', function () {
    return view('contactjob');
});

Auth::routes();


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Ruta de Servicios
    Route::get('/servicesaut', [App\Http\Controllers\admin\ServicesController::class, 'index']);
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
    Route::put('/packages//{id}', [App\Http\Controllers\admin\PackageController::class, 'update']);

    Route::delete('/packages/{package}', [App\Http\Controllers\admin\PackageController::class, 'destroy']);
    Route::delete('/packages/{package}/remove-service', [App\Http\Controllers\admin\PackageController::class, 'removeService']);

    //Ruta Paseadores admin
    Route::resource('walkers','App\Http\Controllers\admin\WalkerController');
    // Ruta Usuarios admin
    Route::resource('users','App\Http\Controllers\admin\UserController');
    Route::resource('blogs','App\Http\Controllers\BlogController');
    Route::get('/blogs/create', [BlogController::class, 'showForm']); // Mostrar formulario de creación de blog
    Route::post('/agregar_blog', [BlogController::class, 'store'])->name('blog.store'); // Almacenar el nuevo blog
    Route::get('/blogs/{ide}/dit', [BlogController::class, 'showEditForm']); // Mostrar formulario de edición
    Route::put('/blogs/{id}', [BlogController::class, 'update']); // Actualizar el blog existente


    Route::post('/users/{userId}/assign-packages', [App\Http\Controllers\admin\UserController::class, 'assignPackages'])->name('users.assign-packages');



    Route::get('/userservices/{userId}/{packageId}', 'App\Http\Controllers\admin\UserController@showPackagesById')
        ->name('users.userservices');

 

    Route::post('/users/{userId}/assign-packages', 'App\Http\Controllers\admin\UserController@assignPackages')
        ->name('users.assignPackages');

    // vista servicios usuario
    Route::get('/users/{userId}/assign-packages-form', 'App\Http\Controllers\admin\UserController@assignPackagesForm')
    ->name('users.assignPackagesForm');

    Route::get('/index', function () {
        return view('index');
    });
});