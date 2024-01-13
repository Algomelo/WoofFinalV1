<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Package;  // Asegúrate de que estás importando la clase Package
use App\Models\Services;
use App\Models\User;
use App\Models\ServiceRequest;

class UserServiceRequestController extends Controller
{

    public function showRequestForm($userId)
    {
        $userId = User::findOrFail($userId);
   
        $allPackages = Package::all();
        $allServices = Services::all();
        $services = Services::all();
        $packages = Package::all();


        return view('users.UserRequestService', compact('userId', 'allPackages', 'allServices', 'services', 'packages'));
    }
    public function showIndexRequest($userId){
        $user = User::findOrFail($userId);
        $serviceRequests = $user->serviceRequests()->orderByDesc('created_at')->get();

        $uniqueNumbers = $serviceRequests->pluck('unique_number');
        // Obtener una colección de los valores únicos de 'unique_number' para cada ServiceRequest

        

        return view('users.UserRequestServiceIndex', compact('serviceRequests', 'userId', 'uniqueNumbers')); 
    }
    
    
    public function store(Request $request)
    {
        // Validar y procesar los datos del formulario según sea necesario
        $validatedData = $request->validate([
            // ... (tus reglas de validación)
            'comment' => 'required',
            'user_id' => 'required',

        ]);
    
        // Generar numero unico
       

        $uniqueNumber = mt_rand(100000, 999999);
        $validatedData['unique_number'] = $uniqueNumber;
        


        $totalPrice = 0;
        // Crear una nueva instancia del modelo ServiceRequest con los datos validados
        $serviceRequest = ServiceRequest::create($validatedData);

        // Calcular el precio en base a los servicios seleccionados
        $selectedServices = $request->input('services', []);
        foreach ($selectedServices as $serviceId) {

            $serviceQuantity = $request->input("service_quantity.$serviceId", 0);
            $service = Services::find($serviceId);
            $priceService = $serviceQuantity * $service->price;
            $totalPrice += $priceService;
    
            // Asociar el servicio a la solicitud a través de la tabla intermedia
            $serviceRequest->services()->attach($serviceId, ['service_quantity' => $serviceQuantity]);
        }

    
    
        // Calcular el precio en base a los paquetes seleccionados
        $selectedPackages = $request->input('packages', []);
        foreach ($selectedPackages as $packageId) {
            $packageQuantity = $request->input("package_quantity.$packageId", 0);
            $package = Package::find($packageId);

            $pricePackage = $packageQuantity * $package->price;
            $totalPrice += $pricePackage;

            // Asociar el paquete a la solicitud a través de la tabla intermedia
            $serviceRequest->packages()->attach($packageId, ['package_quantity' => $packageQuantity]);
        }
    
        // Actualizar el precio total en la solicitud
        $serviceRequest->update(['price' => $totalPrice]);
         // Guardar la solicitud
        $serviceRequest->save();

        // Redireccionar o hacer lo que sea necesario después de la creación
        return redirect()->route('user.showIndexRequest', [
            'userId' => $serviceRequest->user_id,
            'uniqueNumber' => $uniqueNumber,
        ]);
            }

    public function destroy($userId, $serviceRequestId)
{
    $serviceRequest = ServiceRequest::findOrFail($serviceRequestId);
    $serviceRequest->delete();

    // Redireccionar o hacer lo que sea necesario después de la eliminación
    return redirect()->route('user.showIndexRequest', ['userId' => $userId]);
}


public function edit($userId, $serviceRequestId)
{
    
    $userId = User::findOrFail($userId);
    $serviceRequest = ServiceRequest::findOrFail($serviceRequestId);
    $allPackages = Package::all();
    $allServices = Services::all();

    // Puedes pasar más datos necesarios a la vista si es necesario

    return view('users.UserRequestServiceEdit', compact('userId', 'serviceRequest', 'allPackages', 'allServices'));
}

    public function update(Request $request, $serviceRequestId)
    {

        $validatedData = $request->validate([
            'comment' => 'required',
            'user_id' => 'required',
        ]);
    
        $serviceRequest = ServiceRequest::findOrFail($serviceRequestId);
        // Actualiza los campos de la solicitud de servicio
        $serviceRequest->comment = $validatedData['comment'];


        // Elimina todos los servicios asociados a la solicitud actual
        $serviceRequest->services()->detach();

        $selectedServices = $request->input('services');

        $service_quantity = $request->input('service_quantity');
    
        $totalPrice = 0 ;
        // Asocia los servicios y cantidades a la solicitud a través de la relación many-to-many
        if (!empty($selectedServices)) {
            $serviceData = [];
            
            foreach ($selectedServices as $serviceId) {
                $quantity = isset($service_quantity[$serviceId]) ? $service_quantity[$serviceId] : 0;
                $serviceData[$serviceId] = ['service_quantity' => $quantity];
                
            }
    
            $serviceRequest->services()->attach($serviceData);
        }


        $serviceRequest->packages()->detach();


        $selectedPackages = $request->input('packages');
        $package_quantity = $request->input('package_quantity');


                // Asocia los paquetes y cantidades a la solicitud a través de la relación many-to-many
        if (!empty($selectedPackages)) {
            $packageData = [];
            foreach ($selectedPackages as $packageId) {
                $quantity = $package_quantity[$packageId] ?? 0;
                $package = Package::find($packageId);
                $pricePackage = $quantity * $package->price;
                $totalPrice += $pricePackage;
                $packageData[$packageId] = ['package_quantity' => $quantity];
            }
            $serviceRequest->packages()->attach($packageData);
        }

        $selectedPackages = $request->input('packages', []);

        $serviceRequest->update(['price' => $totalPrice]);

        $serviceRequest->save();

       


        return redirect()->route('user.showIndexRequest', [
            'userId' => $serviceRequest->user_id,
        ]);
            }

}