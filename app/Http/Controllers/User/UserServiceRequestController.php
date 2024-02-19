<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Package;  // Asegúrate de que estás importando la clase Package
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

use App\Models\ServiceRequest;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

class UserServiceRequestController extends Controller
{

    public function create()
    {
        $userId = Auth::id();
        $userId = User::findOrFail($userId);
   
        $allPackages = Package::all();
        $allServices = Service::all();
        $services = Service::all();
        $packages = Package::all();


        return view('users.UserRequestService', compact('userId', 'allPackages', 'allServices', 'services', 'packages'));
    }
    public function index(){
        $userId = Auth::id();
        $user = User::findOrFail($userId);
        $serviceRequests = $user->serviceRequests()->orderByDesc('created_at')->get();

        $uniqueNumbers = $serviceRequests->pluck('unique_number');
        // Obtener una colección de los valores únicos de 'unique_number' para cada ServiceRequest
        return view('users.UserRequestServiceIndex', compact('serviceRequests', 'userId', 'uniqueNumbers')); 
    }
    public function update(Request $request, $serviceRequestId)
    {
        $validatedData = $request->validate([
            'comment' => 'nullable', // Ahora el campo 'comment' es opcional
            'user_id' => 'required',
        ]);
        $serviceRequest = ServiceRequest::findOrFail($serviceRequestId);
        $serviceRequest->comment = $validatedData['comment'];
        $serviceRequest->services()->detach();
        $selectedServices = $request->input('services');
        $service_quantity = $request->input('service_quantity');
        $totalPrice = 0 ;
        $serviceDates = $request->input('dates');


        //$datesArray = explode(',', $date); // calcular cantidad
        //$quantity = count($datesArray); // calcular cantidad
        
        if (!empty($selectedServices)) {
            $serviceData = [];
            foreach ($selectedServices as $serviceId) {
                $date = $serviceDates[$serviceId];
                $date = implode(',', $serviceDates[$serviceId]); // separar fechas 
                $quantity = $service_quantity[$serviceId] ?? 0;
                $service = Service::find($serviceId);
                $priceService = $quantity * $service->price;
                $totalPrice += $priceService;
                $serviceData[$serviceId] = ['service_quantity' => $quantity];
            }
            $serviceRequest->services()->attach($serviceData);
        }
        $serviceRequest->date=$date;

        $serviceRequest->packages()->detach();
        $selectedPackages = $request->input('packages');
        $package_quantity = $request->input('package_quantity');
        /*
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
        */
        //$selectedPackages = $request->input('packages', []);
        //$serviceRequest->update(['price' => $totalPrice]);
        $serviceRequest->save();
        return redirect()->route('userServiceRequest.index');
        }    
    
    public function store(Request $request)
    {

        $messages = [
            'services.required' => 'Please select at least one date for a service.',
            'services.*.required' => 'Please select at least one date for a service.',


        ];
    
        $validator = Validator::make($request->all(), [
            'services' => 'required|array|min:1',
            'services.*' => 'required',
            'dates.*.*' => 'nullable',
        ], $messages);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $userId = Auth::id();
        $shift= $request->input('shift');
        $address = $request->input('address');
        $comment = $request->input('comment');
        $totalPrice = 0;
        // Calcular el precio en base a los servicios seleccionados
        $selectedServices = $request->input('services', []);
        $serviceDates = $request->input('dates');

        foreach ($selectedServices as $serviceId) {

            $uniqueNumber = mt_rand(100000, 999999);
            $date = $serviceDates[$serviceId];
            $date = implode(',', $serviceDates[$serviceId]); // separar fechas 
            $datesArray = explode(',', $date); // calcular cantidad
            $quantity = count($datesArray); // calcular cantidad
            $serviceRequest = ServiceRequest::create([
                'unique_number' => $uniqueNumber,
                'user_id' => $userId,
                'comment' => $comment,
                'date' => $date,
                'shift' => $shift,
                'address' => $address,
                'state' => "Send",
                'quantity' => $quantity,
            ]);
            
            $serviceQuantity = $request->input("service_quantity.$serviceId", 0);

            $service = Service::find($serviceId);
            $priceService = $quantity * $service->price;
            $totalPrice += $priceService;
            $serviceRequest->update(['price' => $totalPrice]);
            // Guardar la solicitud
            $serviceRequest->save();
            // Asociar el servicio a la solicitud a través de la tabla intermedia
            $serviceRequest->services()->attach($serviceId, ['service_quantity' => $serviceQuantity]);
        }
        // Calcular el precio en base a los paquetes seleccionados
        /*
        $selectedPackages = $request->input('packages', []);
        foreach ($selectedPackages as $packageId) {
            $packageQuantity = $request->input("package_quantity.$packageId", 0);
            $package = Package::find($packageId);
            $pricePackage = $packageQuantity * $package->price;
            $totalPrice += $pricePackage;
            // Asociar el paquete a la solicitud a través de la tabla intermedia
            $serviceRequest->packages()->attach($packageId, ['package_quantity' => $packageQuantity]);
        }
    */
        // Actualizar el precio total en la solicitud




        // Redireccionar o hacer lo que sea necesario después de la creación
        return redirect()->route('userServiceRequest.index');

            }



    public function edit( $serviceRequestId)
    {
        $userId = Auth::id();
        $userId = User::findOrFail($userId);
        $serviceRequest = ServiceRequest::findOrFail($serviceRequestId);
        $allPackages = Package::all();
        $allServices = Service::all();
        $scheduledDates = $this->getFormattedScheduledDates($serviceRequest->date);   //  datos para mostrar el calendario 

        // Puedes pasar más datos necesarios a la vista si es necesario

        return view('users.UserRequestServiceEdit', compact('userId', 'serviceRequest', 'allPackages', 'allServices' , 'scheduledDates'));
    }

    private function getFormattedScheduledDates($scheduledDates)
    {
        // Convierte las fechas almacenadas en la base de datos al formato adecuado para JavaScript
        $formattedDates = [];

        foreach (explode(',', $scheduledDates) as $date) {
            $formattedDates[] = Carbon::parse($date)->format('Y-m-d');
        }

        return $formattedDates;
    }





         public function destroy( $serviceRequestId)
        {
            $serviceRequest = ServiceRequest::findOrFail($serviceRequestId);
            $serviceRequest->delete();

            // Redireccionar o hacer lo que sea necesario después de la eliminación
            return redirect()->route('userServiceRequest.index');
        }


}