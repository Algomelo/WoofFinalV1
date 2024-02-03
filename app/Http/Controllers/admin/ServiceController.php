<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $services = Service::all();

        return view('services.index', compact('services'));

    }

    public function create(){
        
        return view('services.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'price' => 'required'
        ];
        $message = [
            'name.required' => 'Service name is required.',
            'name.min' => 'The name of the service must have more than 3 characters.',
            'price.required' => 'The price of the service is mandatory.',
        ];
        $this->validate($request,$rules,$message);

        $service = new Service();
        $service->name =$request->input('name');
        $serviceName=$service->name;
        $service->description =$request->input('description');
        $service->price =$request->input('price');
        $service->save();
        $notification = 'The ' . $serviceName. ' service has been created successfully';
        return redirect('/services')->with(compact('notification'));
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
    public function edit($id) {
        $service = Service::findOrFail($id);
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, Service $service){

        $rules = [
            'name' => 'required|min:3',
            'price' => 'required'
        ];
        $message = [
            'name.required' => 'Service name is required.',
            'name.min' => 'The name of the service must have more than 3 characters.',
            'price.required' => 'The price of the service is mandatory.',
        ];
        $this->validate($request,$rules,$message);

        $editName = $service->name;
        $service->name =$request->input('name');
        $service->description =$request->input('description');
        $service->price =$request->input('price');
        $service->save();
        $notification = 'The ' .$editName .' service has been successfully modified';
        return redirect('/services')->with(compact('notification'));
    }

    public function destroy(Service $service){

        $deleteName = $service->name;
        $service->delete();
        $notification = 'The '.$deleteName. 'service has been successfully removed.';


        return redirect('/services')->with(compact('notification'));


    }
}
