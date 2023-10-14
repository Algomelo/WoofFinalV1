<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Services;
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
         'price' => 'required|numeric|min:0',
         'services' => 'required|array', // Cambio de 'selected_services' a 'services'
         'services.*' => 'required|integer', // Cambio de 'selected_services.*' a 'services.*'
         'quantities' => 'required|array',
         'quantities.*' => 'required|integer|min:1',
     ]);
 
     // Crear un nuevo paquete con los datos proporcionados
     $package = new Package([
         'name' => $request->input('name'),
         'description' => $request->input('description'),
         'price' => $request->input('price'),
     ]);
     $package->save();
 
     // Obtener los IDs de los servicios y las cantidades desde el formulario
     $serviceIds = $request->input('services'); // Cambio de 'selected_services' a 'services'
     $quantities = $request->input('quantities');
 
     // Asociar los servicios al paquete con sus respectivas cantidades
     foreach ($serviceIds as $index => $serviceId) {
         $quantity = $quantities[$index];
         $package->services()->attach($serviceId, ['quantity' => $quantity]);
     }
 
     // Redirigir a la página de listado de paquetes con un mensaje de éxito
     return redirect('/packages')->with('success', 'Package created successfully.');
 }
 

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $package = Package::findOrFail($id);
        $services = Services::all(); // Obtener todos los servicios para mostrar en el formulario
        
    return view('packages.edit', compact('package', 'services'));
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

        'services' => 'required|array', // Cambio de 'selected_services' a 'services'
        'services.*' => 'required|integer', // Cambio de 'selected_services.*' a 'services.*'
        'quantities' => 'required|array',
        'quantities.*' => 'required|integer|min:1',
    ]);

    // Obtener el paquete a editar
    $package = Package::findOrFail($id);

    // Actualizar los datos del paquete
    $package->update([
        'name' => $request->input('name'),
        'description' => $request->input('description'),
        'price' => $request->input('price'),
    ]);

    // Obtener los IDs de los servicios y las cantidades desde el formulario
    $serviceIds = $request->input('services'); // Cambio de 'selected_services' a 'services'
    $quantities = $request->input('quantities');

    // Sincronizar los servicios asociados con el paquete y sus cantidades
    $package->services()->detach();
    foreach ($serviceIds as $index => $serviceId) {
        $quantity = $quantities[$index];
        $package->services()->attach($serviceId, ['quantity' => $quantity]);
    }

    return redirect('/packages')->with('success', '¡El paquete ha sido actualizado exitosamente!');
}
    

    public function removeService(Request $request, $id)
    {
    try {
        $package = Package::findOrFail($id);
        $serviceName = $request->input('service');

        $package->services()->detach(Services::where('name', $serviceName)->first());

        return response()->json(['message' => 'Service removed successfully'], 200);
     } catch (\Exception $e) {
        return response()->json(['message' => 'An error occurred while removing the service'], 500);
     }
    }
    public function destroy(string $id)
    {
        $package = Package::findOrFail($id);
        $package->delete();
    
        return redirect('/packages')->with('success', 'El paquete ha sido eliminado exitosamente.');
    }
}

