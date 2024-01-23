<?php

namespace App\Http\Controllers\admin;


use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Services;
use App\Models\Users;
use App\Http\Controllers\Controller;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packages = Package::all();
        return view('packages.index', compact('packages'));
    }
    
    // Mostrar el formulario para crear un nuevo paquete
    public function create()
    {
        $services = Services::all(); // Obtener todos los servicios para mostrar en el formulario
        return view('packages.create', compact('services'));
    }

    // Almacenar un nuevo paquete en la base de datos
    public function store(Request $request)
    {
        // Validar los datos ingresados en el formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'services' => 'required|array',
            'services.*' => 'required|integer',
            'quantities' => 'required|array',
            'quantities.*' => 'min:0',
    
        ]);

        // Crear un nuevo paquete con los datos proporcionados
        $package = new Package([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'custom_price' => $request->input('custom_price') === 'on', // Ajusta aquí para interpretar correctamente el valor

        ]);

        // Calcula el precio total del paquete llamando a la función updateTotalPrice
        $totalPrice = $this->updateTotalPrice($request);

        // Establece el precio total en el paquete
        $package->price = $totalPrice;

        $package->save();

        // Obtener los IDs de los servicios y las cantidades desde el formulario
        // Obtener los IDs de los servicios seleccionados
        // Obtener los IDs de los servicios seleccionados
        $selectedServices = $request->input('services');

        // Obtener todas las cantidades de servicio del formulario
        $quantities = $request->input('quantities');

        // Crear un array para almacenar los datos de servicios y cantidades
        $serviceData = [];

        // Recorrer los servicios seleccionados
        foreach ($selectedServices as $serviceId) {
            // Verificar si el servicio tiene una cantidad válida
            $quantity = isset($quantities[$serviceId]) ? $quantities[$serviceId] : 0;

            // Agregar el servicio y cantidad al array de datos
            $serviceData[$serviceId] = ['quantity' => $quantity];
        }

        // Asociar los servicios al paquete con sus respectivas cantidades
        $package->services()->sync($serviceData);
        $namePackage= $request->input('name');
        // Redirigir a la página de listado de paquetes con un mensaje de éxito
        $notification = 'The ' .$namePackage. ' package has been created successfully';

        return redirect('/packages')->with(compact('notification'));

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $package = Package::find($id);
        $services = $package->services;
        
        // Calcular la cantidad de servicios actuales
        $currentServiceCount = $services->count();
    
        // Calcular el valor actual del paquete
        $currentPackagePrice = $package->price;
        $custom_price = $package->custom_price;


        $allServices = Services::all();
        $isChecked = $custom_price ? 'checked' : '';


        
        return view('packages.edit', compact('package', 'services', 'allServices', 'currentServiceCount', 'currentPackagePrice' ,'custom_price', 'isChecked'));


    }

    /**
     * Update the specified resource in storage.
     */
    // PackageController.php
 

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'price' => 'required|integer',
            'services' => 'required|array',
            'services.*' => 'required|integer',
            'quantities' => 'required|array',
            'quantities.*' => 'min:0',
        ]);
    
        // Obtener el paquete a editar
        $package = Package::findOrFail($id);
    
        // Actualizar los datos del paquete
        $package->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);
    
        // Obtener los IDs de los servicios y las cantidades desde el formulario
        $serviceIds = $request->input('services');
        $quantities = $request->input('quantities');

        // Eliminar servicios no seleccionados y sus cantidades
        $servicesToRemove = $package->services->pluck('id')->diff($serviceIds);
        
        $package->services()->detach($servicesToRemove);

        // Actualizar las cantidades de los servicios seleccionados y agregar nuevos servicios
        foreach ($serviceIds as $index => $serviceId) {
            $quantity = isset($quantities[$index]) ? $quantities[$index] : 0;

            // Actualizar o agregar la relación en la tabla intermedia
            $package->services()->syncWithoutDetaching([$serviceId => ['quantity' => $quantity]]);
        }

        // Identificar nuevos servicios a agregar

    
        // Actualizar el precio total del paquete
        $totalPrice = $this->updateTotalPrice($request);
    
        // Establecer el precio total en el paquete
        $package->price = $totalPrice;
    
        // Guardar el paquete
        $package->save();
        $namePackage= $request->input('name');
        // Redirigir a la página de listado de paquetes con un mensaje de éxito
        $notification = 'The ' .$namePackage. ' package has been updated successfully';

        return redirect('/packages')->with(compact('notification'));
    }
    
    

    public function destroy(string $id)
    {
        $package = Package::findOrFail($id);
        $package->delete();
        $namePackage= $package->name;
        // Redirigir a la página de listado de paquetes con un mensaje de éxito
        $notification = 'The ' .$namePackage. ' package has been updated successfully';
        return redirect('/packages')->with(compact('notification'));
    }

    private function updateTotalPrice(Request $request)
    {
        $totalPrice = $request->input('price');
        $serviceIds = $request->input('services');
        $quantities = $request->input('quantities');
        $customPrice = $request->has('enable_custom_price');
    
        if ($totalPrice === null || $totalPrice === 0) {
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
    
        return $totalPrice;
    }

    // Resto del código...
    }







