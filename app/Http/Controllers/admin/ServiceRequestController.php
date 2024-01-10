<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\admin\PackageController;
use App\Http\Controllers\admin\ServicesController;
use App\Http\Controllers\admin\UserController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Package;  // Asegúrate de que estás importando la clase Package
use App\Models\Services;
use App\Models\User;
use App\Models\ServiceRequest;
use Illuminate\Support\Facades\View;


class ServiceRequestController extends Controller
{

    public function edit($userId, $serviceRequestId)
    {
        $serviceRequest = ServiceRequest::findOrFail($serviceRequestId);
        $uniqueNumbers = $serviceRequest->pluck('unique_number');
        $allServices = Services::all();
        $allPackages = Package::all();

        return view('admin.AdminRequestServiceEdit', compact('serviceRequest', 'userId', 'uniqueNumbers', 'allServices' ,'allPackages'));

    }
    public function create()
    {
        // Obtener la lista de todos los usuarios disponibles
        $allUsers = User::all(); // Ajusta según tus necesidades

        // Obtener la lista de todos los servicios y paquetes disponibles
        $allServices = Services::all(); // Ajusta según tus necesidades
        $allPackages = Package::all(); // Ajusta según tus necesidades

        return view('admin.AdminRequestServiceCreate', compact('allUsers', 'allServices', 'allPackages'));

    }
        public function showIndexRequest()
    {

        $serviceRequests = ServiceRequest::all()->sortByDesc('created_at');
        $uniqueNumbers = $serviceRequests->pluck('unique_number');


        return view('admin.AdminRequestServiceIndex', compact('serviceRequests', 'uniqueNumbers')); 

    }

    public function store(Request $request)
    {
    $validatedData = $request->validate([
        'comment' => 'required',
        'state' => 'required',
        'services' => 'array',
        'packages' => 'array',
        'assigned_user' => 'required|exists:users,id',
    ]);

    // Generar un número único aleatorio  //
    $uniqueNumber = mt_rand(100000, 999999);
    $validatedData['unique_number'] = $uniqueNumber;

    // Obtener el usuario asignado //
    $assignedUserId = $validatedData['assigned_user'];

    // Crear una nueva instancia del modelo ServiceRequest con los datos validados //
    $serviceRequest = ServiceRequest::create([
        'comment' => $validatedData['comment'],
        'state' => $validatedData['state'],
        'unique_number' => $validatedData['unique_number'],
        'user_id' => $assignedUserId,
    ]);

    // Obtén el precio de la solicitud desde la solicitud // Actualizar precio con funcion UpdateTotalPrice
    $totalPrice = $request->input('price');
    
    $totalPrice = $this->updateTotalPrice($request);
    // Verifica que el precio no sea nulo antes de actualizar la base de datos
    if ($totalPrice !== null) {
        // Establece el precio total en la solicitud
        $serviceRequest->price = $totalPrice;
        // Guarda la solicitud en la base de datos
        $serviceRequest->save();
    } else{


    }
 
    // Obtener los IDs de los servicios seleccionados //
    $selectedServices = $request->input('services');
    // Obtener todas las cantidades de servicio del formulario
    $service_quantity = $request->input('service_quantity');
    // Crear un array para almacenar los datos de servicios y cantidades
    $serviceData = [];
    // Recorrer los servicios seleccionados
    if (!empty($selectedServices)) {

    foreach ($selectedServices as $serviceId) {
        // Verificar si el servicio tiene una cantidad válida
        $quantity = isset($service_quantity[$serviceId]) ? $service_quantity[$serviceId] : 0;
        // Agregar el servicio y cantidad al array de datos
        $serviceData[$serviceId] = ['service_quantity' => $quantity];
        }
    }
    // Asociar servicios y cantidades a la solicitud a través de la relación many-to-many
    $serviceRequest->services()->attach($serviceData);

    $selectedPackages = $request->input('packages');
    // Obtener todas las cantidades de servicio del formulario
    $package_quantity = $request->input('package_quantity');
    // Crear un array para almacenar los datos de servicios y cantidades
    $packageData = [];
    // Recorrer los servicios seleccionados
    if (!empty($selectedPackages)) {
        foreach ($selectedPackages as $packageId) {
            // Verificar si el servicio tiene una cantidad válida y asignar 0 si no está presente
            $quantity = $package_quantity[$packageId] ?? 0;
            // Agregar el servicio y cantidad al array de datos
            $packageData[$packageId] = ['package_quantity' => $quantity];
        }
    }
    // Asociar paquetes y cantidades a la solicitud a través de la relación many-to-many

    
    $serviceRequest->packages()->attach($packageData);


    
    return redirect()->route('admin.showIndexRequest');
    }


    public function update(Request $request, $serviceRequestId)
    {
    $validatedData = $request->validate([
        'comment' => 'required',
        'state' => 'required',
        'services' => 'array',
        'packages' => 'array',
    ]);

    // Obtén la solicitud de servicio existente por su ID


    $serviceRequest = ServiceRequest::findOrFail($serviceRequestId);

    // Actualiza los campos de la solicitud de servicio
    $serviceRequest->comment = $validatedData['comment'];
    $serviceRequest->state = $validatedData['state'];



    // Actualiza el precio de la solicitud utilizando la función updateTotalPrice
    $totalPrice = $this->updateTotalPrice($request);
    if ($totalPrice !== null) {
        $serviceRequest->price = $totalPrice;
    }

    // Guarda la solicitud de servicio actualizada en la base de datos
    $serviceRequest->save();


    // Elimina todos los servicios asociados a la solicitud actual
    $serviceRequest->services()->detach();

    // Obtén los servicios seleccionados y sus cantidades del formulario
    $selectedServices = $request->input('services');

    $service_quantity = $request->input('service_quantity');


    // Asocia los servicios y cantidades a la solicitud a través de la relación many-to-many
    if (!empty($selectedServices)) {
        $serviceData = [];
        
        foreach ($selectedServices as $serviceId) {
            $quantity = isset($service_quantity[$serviceId]) ? $service_quantity[$serviceId] : 0;
            $serviceData[$serviceId] = ['service_quantity' => $quantity];
        }

        $serviceRequest->services()->attach($serviceData);
    }


    // Elimina todos los paquetes asociados a la solicitud actual
    $serviceRequest->packages()->detach();

    // Obtén los paquetes seleccionados y sus cantidades del formulario
    $selectedPackages = $request->input('packages');
    $package_quantity = $request->input('package_quantity');

    // Asocia los paquetes y cantidades a la solicitud a través de la relación many-to-many
    if (!empty($selectedPackages)) {
        $packageData = [];
        foreach ($selectedPackages as $packageId) {
            $quantity = $package_quantity[$packageId] ?? 0;
            $packageData[$packageId] = ['package_quantity' => $quantity];
        }
        $serviceRequest->packages()->attach($packageData);
    }

    // Redirige a la vista deseada después de la actualización
    return redirect()->route('admin.showIndexRequest');
}


/*

public function updateServiceRequest(Request $request, $userId, $serviceRequestId)
    {
        $validatedData = $request->validate([
            'comment' => 'required',
            'state' => 'required',
            'services' => 'array',
            'packages' => 'array',
        ]);
        $totalPrice = $request->input('price');

        $totalPrice = $this->updateTotalPrice($request);
        $totalPrice = $this->updateTotalPrice($request);

        // Obtener la solicitud de servicio por ID
        $serviceRequest = ServiceRequest::findOrFail($serviceRequestId);
    
        // Actualizar los campos básicos de la solicitud
        $serviceRequest->update([
            'comment' => $validatedData['comment'],
            'state' => $validatedData['state'],
            'price' => 0, // Actualizar el precio
        ]);



            // Actualizar las cantidades para los servicios
    foreach ($request->input('service_quantity', []) as $serviceId => $quantity) {
        $serviceRequest->services()->updateExistingPivot($serviceId, ['service_quantity' => $quantity]);
    }

    // Actualizar las cantidades para los paquetes
    foreach ($request->input('package_quantity', []) as $packageId => $quantity) {
        $serviceRequest->packages()->updateExistingPivot($packageId, ['package_quantity' => $quantity]);
    }
        // Actualizar servicios asociados
        $selectedServices = $request->input('services');
        $service_quantity = $request->input('service_quantity');
        $serviceData = [];
    
        foreach ($selectedServices as $serviceId) {
            $quantity = isset($service_quantity[$serviceId]) ? $service_quantity[$serviceId] : 0;
            $serviceData[$serviceId] = ['service_quantity' => $quantity];
        }
    
        $serviceRequest->services()->sync($serviceData);
    
        // Actualizar paquetes asociados
        $selectedPackages = $request->input('packages');
        $package_quantity = $request->input('package_quantity');
        $packageData = [];
    
        foreach ($selectedPackages as $packageId) {
            $quantity = isset($package_quantity[$packageId]) ? $package_quantity[$packageId] : 0;
            $packageData[$packageId] = ['package_quantity' => $quantity];
        }
    
        $serviceRequest->packages()->sync($packageData);
    
        return redirect()->route('admin.showIndexRequest');
    }
    
*/
    

    private function updateTotalPrice(Request $request)
    {
        $totalPrice = $request->input('price');
        $serviceIds = $request->input('services');


        $quantities = $request->input('service_quantity');
        $packageIds = $request->input('packages');
    
        $packageQuantities = $request->input('package_quantity');
        $customPrice = $request->has('enable_custom_price');

        if ($totalPrice === null || $totalPrice === 0) {

            if(!empty($serviceIds)){
            // Suma de precios de servicios seleccionados si el precio es nulo o 0
            foreach ($serviceIds as $index => $serviceId) {
                if (isset($quantities[$serviceId]) && $quantities[$serviceId] > 0) {
                    $quantity = $quantities[$serviceId];
                    $service = Services::find($serviceId);
                    if ($service) {
                        $totalPrice += $service->price * $quantity;
                    }
                }
            }
            }

            if (!empty($packageIds)) {
                foreach ($packageIds as $index => $packageId) {
                    if (isset($packageQuantities[$packageId]) && $packageQuantities[$packageId] > 0) {
                        $packageQuantity = $packageQuantities[$packageId];
                        $package = Package::find($packageId);
                        if ($package) {
                            $totalPrice += $package->price * $packageQuantity;
                        }
                    }
                }
            }
            // Suma de precios de paquetes seleccionados

        }

        return $totalPrice;
    }

    public function destroy( $serviceRequestId)
    {
        $serviceRequest = ServiceRequest::findOrFail($serviceRequestId);
        $serviceRequest->delete();

        // Redireccionar o hacer lo que sea necesario después de la eliminación
        return redirect()->route('admin.showIndexRequest');
    }





}