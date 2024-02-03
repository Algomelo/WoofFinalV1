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
Route::view('/services','services2')->name('services') ;
Route::view('/gallery','gallery')->name('gallery');
Route::view('/aboutus','aboutus')->name('about');
Route::view('/contactusers','contactusers')->name('contactusers');
Route::view('/contactjob','contactjob') ->name('contactjob');







Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ... otras rutas


Auth::routes();



Route::middleware(['auth', 'user'])->group(function () {

    // CRUD SERVICE REQUEST USER
    Route::get('/user/{userId}/send-request-form', [UserServiceRequestController::class, 'showRequestForm'])
        ->name('user.sendRequestForm');
    Route::post('/user/{userId}/send-request', [UserServiceRequestController::class, 'store'])
        ->name('user.sendRequest');
    Route::get('/users/{userId}/showIndexRequest', [UserServiceRequestController::class, 'showIndexRequest'])
        ->name('user.showIndexRequest');
    Route::delete('/user/{userId}/service-request/{serviceRequestId}', [UserServiceRequestController::class, 'destroy'])
    ->name('user.deleteServiceRequest');
    Route::get('/user/{userId}/service-request/{serviceRequestId}/edit', [UserServiceRequestController::class, 'edit'])
    ->name('user.editServiceRequest');
    Route::put('/users/service-requests/{serviceRequestId}', [UserServiceRequestController::class, 'update'])
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


    // Ruta para vista de redencion o asignacion de  agendamientos de servicio

    Route::get('/admin/redem/index', [AdminRedemController::class, 'index'])->name('admin.IndexRedem');
    Route::get('/admin/redem/{scheduledId}/edit', [AdminRedemController::class, 'edit'])->name('admin.EditRedem');
    Route::put('/admin/redem/{scheduledId}/store', [AdminRedemController::class, 'store'])->name('admin.StoreRedem');


    // Ruta servicios agendados

    Route::get('/admin/scheduled/index', [AdminScheduledController::class, 'index'])->name('admin.IndexScheduled');

});

