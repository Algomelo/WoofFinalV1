<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ContactForm;
use App\Http\Controllers\ContactJobController;
use App\Http\Controllers\LandingController;

use App\Http\Controllers\User\UserRedemptionController;
use App\Http\Controllers\Walker\WalkerScheduledController;
use App\Http\Controllers\admin\AdminRedemController;
use App\Http\Controllers\UserPreferenceController;

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
    Route::put('manualPreference', [UserPreferenceController::class, 'updateShowManualPreference'])->name('update.show_manual_preference');
    Route::resource('userServiceRequest','App\Http\Controllers\User\UserServiceRequestController');

    // CRUD SERVICE REQUEST USER

    
    // CRUD PETS
    Route::resource('userPets','App\Http\Controllers\User\PetController');

    // CRUD AGENDAMIENTO
    Route::get('/userRedemption/create/{redeemedServiceId}', [UserRedemptionController::class, 'create']);
    Route::post('/userRedemption/store/{redeemedServiceId}', [UserRedemptionController::class, 'store']);

    Route::resource('userRedemption', 'App\Http\Controllers\User\UserRedemptionController');

    Route::resource('userScheduled','App\Http\Controllers\User\UserScheduledController');


});

Route::middleware(['auth', 'walker'])->group(function () {
    Route::resource('walkersScheduled','App\Http\Controllers\Walker\WalkerScheduledController');

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
    
    Route::put('serviceRedems/store/{scheduledId}', [AdminRedemController::class, 'store']);

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

URL::forceScheme('https');
