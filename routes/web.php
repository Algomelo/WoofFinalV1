<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ContactForm;
use App\Http\Controllers\ContactJobController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\ServicesController;
use App\Http\Controllers\admin\ServiceRequestController;
use App\Http\Controllers\admin\PackageController;
use App\Http\Controllers\user\UserServiceRequestController;
use App\Http\Controllers\user\PetController;
use App\Http\Controllers\user\ScheduledController;

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
Route::view('/services','services2')->name('services') ;
Route::view('/gallery','gallery')->name('gallery');
Route::view('/aboutus','aboutus')->name('about');
Route::view('/contactusers','contactusers')->name('contactusers');
Route::view('/contactjob','contactjob') ->name('contactjob');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ... otras rutas


Auth::routes();
Route::middleware(['auth', 'user'])->group(function () {

    Route::get('/user/{userId}/send-request-form', [UserServiceRequestController::class, 'showRequestForm'])
        ->name('user.sendRequestForm');

    // CRUD SERVICE REQUEST USER
    Route::post('/user/{userId}/send-request', [UserServiceRequestController::class, 'store'])
        ->name('user.sendRequest');
    Route::get('/users/{userId}/showIndexRequest', [UserServiceRequestController::class, 'showIndexRequest'])
        ->name('user.showIndexRequest');
    Route::delete('/user/{userId}/service-request/{serviceRequestId}', [UserServiceRequestController::class, 'destroy'])
    ->name('user.deleteServiceRequest');
    Route::get('/user/{userId}/service-request/{serviceRequestId}/edit', [UserServiceRequestController::class, 'edit'])
    ->name('user.editServiceRequest');
    Route::put('/user/{userId}/service-request/{serviceRequestId}', [UserServiceRequestController::class, 'update'])
    ->name('user.updateServiceRequest');

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
    Route::get('/user/scheduled/{userId}', [ScheduledController::class, 'index'])
    ->name('user.scheduled.index');


    Route::get('/user/scheduled/{userId}/scheduledcreate', [PetController::class, 'create'])
    ->name('user.pets.create');


    Route::post('/user/pets/{userId}/petsstore', [PetController::class, 'store'])
    ->name('user.pets.store');
    Route::delete('/user/pets/{userId}/destroy/{petId}', [PetController::class, 'destroy'])
    ->name('user.pets.destroy');
    Route::get('/user/pets/{userId}/edit/{petId}', [PetController::class, 'edit'])
    ->name('user.pets.edit');
    Route::put('/user/pets/{userId}/update/{petId}', [PetController::class, 'update'])
        ->name('user.pets.update');




});

Route::middleware(['auth', 'admin'])->group(function () {

    // CRUD de Servicios
    Route::get('/servicesaut', [ServicesController::class, 'index']);
    Route::get('/services/create', [ServicesController::class, 'create']);
    Route::get('/services/{service}/edit', [ServicesController::class, 'edit']);
    Route::post('/services', [ServicesController::class, 'sendData']);
    Route::put('/services/{service}', [ServicesController::class, 'update']);
    Route::delete('/services/{service}', [ServicesController::class, 'destroy']);
    // CRUD de Paquetes
    Route::get('/packages', [PackageController::class, 'index']);
    Route::get('/packages/create', [PackageController::class, 'create']);
    Route::get('/packages/{package}/edit', [PackageController::class, 'edit']);
    Route::post('/packages', [PackageController::class, 'store']);
    Route::put('/packages//{id}', [PackageController::class, 'update']);
    Route::delete('/packages/{package}', [PackageController::class, 'destroy']);
    //Ruta Paseadores admin
    Route::resource('walkers','App\Http\Controllers\admin\WalkerController');
    // Ruta Usuarios admin
    Route::resource('users','App\Http\Controllers\admin\UserController');
    Route::resource('blogs','App\Http\Controllers\BlogController');
    // Ruta blog admin
    Route::get('/blogs/create', [BlogController::class, 'showForm']); // Mostrar formulario de creación de blog
    Route::post('/agregar_blog', [BlogController::class, 'store'])->name('blog.store'); // Almacenar el nuevo blog
    Route::get('/blogs/{ide}/dit', [BlogController::class, 'showEditForm']); // Mostrar formulario de edición
    Route::put('/blogs/{id}', [BlogController::class, 'update']); // Actualizar el blog existente
    // Ruta solicitud de servicios admin
    Route::post('/users/{userId}/assign-packages', [UserController::class, 'assignPackages'])->name('users.assign-packages');
    Route::get('/userservices/{userId}/{packageId}', [UserController::class,'showPackagesById'])
        ->name('users.userservices');
    Route::post('/users/{userId}/assignPackages', [UserController::class,'assignPackagesForm'])
        ->name('users.assignPackagesForm');
    // vista administracion usuario
    Route::get('/users/{userId}/assign-request-form', [UserController::class,'assignRequestForm'])
    ->name('admin.assignPackagesForm');
    Route::post('/users/{userId}/assign-request-form', [ServiceRequestController::class,'assignRequest'])
    ->name('admin.assignRequestForm');

    Route::post('/delete-selected-users', 'App\Http\Controllers\admin\UserController@deleteSelectedUsers');

    // Ruta para solicitudes de servicio
    
    Route::post('/service-requests', [ServiceRequestController::class, 'store'])
        ->name('admin.storeRequest');


    Route::get('/admin/service-requests', [ServiceRequestController::class, 'showIndexRequest'])->name('admin.showIndexRequest');

    Route::get('/admin/service-requests/{userId}/{serviceRequestId}/edit', [ServiceRequestController::class, 'edit'])->name('admin.editServiceRequest');

    Route::put('/admin/update-service-request/{serviceRequestId}', [ServiceRequestController::class, 'update'])->name('admin.updateServiceRequest');
    Route::delete('/admin/delete-service-request/{serviceRequestId}', [ServiceRequestController::class, 'destroy'])->name('admin.deleteServiceRequest');

    Route::get('/service-requests/create', [ServiceRequestController::class, 'create'])
    ->name('serviceRequests.create');

    Route::post('/admin/calculate-total-price', [ServiceRequestController::class, 'calculateTotalPrice'])->name('admin.calculateTotalPrice');
    Route::post('/admin/attach-services-packages', [ServiceRequestController::class, 'attachServicesAndPackages'])->name('admin.attachServicesAndPackages');
});

