<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ContactForm;
use App\Http\Controllers\ContactJobController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\user\UserServiceRequestController;
use App\Http\Controllers\user\PetController;
use App\Http\Controllers\user\UserRedemptionController;
use App\Http\Controllers\admin\AdminRedemController;
use App\Http\Controllers\walker\WalkerScheduledController;
use App\Http\Controllers\user\UserScheduledController;

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
Route::view('/landing','landing')->name('landing');
Route::view('/','index')->name('index');;
//Route::view('/services','services2')->name('services') ;
Route::view('/gallery','gallery')->name('gallery');
Route::view('/aboutus','aboutus')->name('about');
Route::view('/contactusers','contactusers')->name('contactusers');
Route::view('/contactjob','contactjob') ->name('contactjob');







Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ... otras rutas


Auth::routes();



Route::middleware(['auth', 'user'])->group(function () {
    Route::resource('userServiceRequest','App\Http\Controllers\User\UserServiceRequestController');

    // CRUD SERVICE REQUEST USER

    
    // CRUD PETS
    Route::get('/user/pets/{userId}', [PetController::class, 'index'])
    ->name('user.pets.index');
    Route::get('/user/pets/{userId}/petscreate', [PetController::class, 'create'])
    ->name('user.pets.create');
    Route::post('/user/pets/{userId}/petsstore', [PetController::class, 'store'])
    ->name('user.pets.store');
    Route::delete('/user/pets/{userId}/destroy/{petId}', [PetController::class, 'destroy'])
    ->name('user.pets.destroy');
    Route::get('/user/pets/{userId}/edit/{petId}', [PetController::class, 'edit'])
    ->name('user.pets.edit');
    Route::put('/user/pets/{userId}/update/{petId}', [PetController::class, 'update'])
        ->name('user.pets.update');

    // CRUD AGENDAMIENTO
    Route::get('/user/UserRedemptionController/{userId}', [UserRedemptionController::class, 'index'])
    ->name('user.RedemptionController.index');
    Route::get('/user/UserRedemptionController/{userId}/{redeemedServiceId}/create', [UserRedemptionController::class, 'create'])
    ->name('user.RedemptionController.create');
    Route::post('/user/UserRedemptionController/{userId}/{redeemedServiceId}/store', [UserRedemptionController::class, 'store'])
    ->name('user.RedemptionController.store');


    Route::get('/user/UserScheduledController/index', [UserScheduledController::class, 'index'])
    ->name('user.IndexScheduled');


});

Route::middleware(['auth', 'walker'])->group(function () {

    Route::get('/walker/scheduled/index', [WalkerScheduledController::class, 'index'])->name('walker.IndexScheduled');

});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('walkers','App\Http\Controllers\admin\WalkerController');
    // Ruta Usuarios admin
    Route::resource('users','App\Http\Controllers\admin\UserController');
    Route::post('/delete-selected-users', 'App\Http\Controllers\admin\UserController@deleteSelectedUsers');
    // CRUD de Servicios //* //*
    Route::resource('services','App\Http\Controllers\admin\ServiceController');

    Route::resource('packages','App\Http\Controllers\admin\PackageController');

    Route::resource('serviceRequests','App\Http\Controllers\admin\ServiceRequestController');
    

    Route::resource('serviceRedems','App\Http\Controllers\admin\AdminRedemController');


    // Ruta servicios agendados

    // Ejemplo para una ruta web
    Route::resource('blogs','App\Http\Controllers\BlogController');

    // Ruta blog admin
    Route::get('/blogs/create', [BlogController::class, 'showForm']); // Mostrar formulario de creación de blog
    Route::post('/agregar_blog', [BlogController::class, 'store'])->name('blog.store'); // Almacenar el nuevo blog
    Route::get('/blogs/{ide}/dit', [BlogController::class, 'showEditForm']); // Mostrar formulario de edición
    Route::put('/blogs/{id}', [BlogController::class, 'update']); // Actualizar el blog existente
    // Ruta solicitud de servicios admin



});

