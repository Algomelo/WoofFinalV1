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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Services::all();
        
    return view('packages.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // PackageController.php
 public function store(Request $request)
 {
     $package = Package::create([
         'name' => $request->input('name'),
         'description' => $request->input('description'),
         'price' => $request->input('price'),
     ]);
      $services = $request->input('services');
     $quantities = $request->input('quantities');
      for ($i = 0; $i < count($services); $i++) {
         $package->services()->attach($services[$i], ['quantity' => $quantities[$i]]);
     }
      return redirect()->route('packages.index')->with('success', 'Package created successfully');
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
        $services = Services::all();
    return view('packages.edit', compact('package', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    // PackageController.php
 public function update(Request $request, Package $package)
 {
     $package->update([
         'name' => $request->input('name'),
         'description' => $request->input('description'),
         'price' => $request->input('price'),
     ]);
      $services = $request->input('services');
     $quantities = $request->input('quantities');
      $package->services()->detach();
      for ($i = 0; $i < count($services); $i++) {
         $package->services()->attach($services[$i], ['quantity' => $quantities[$i]]);
     }
      return redirect()->route('packages.index')->with('success', 'Package updated successfully');
 }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $package = Package::findOrFail($id);
        $package->delete();
    
        return redirect()->route('packages.index')->with('success', 'El paquete ha sido eliminado exitosamente.');
    }
}
