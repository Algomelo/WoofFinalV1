<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\Services;
use App\Http\Controllers\Controller;


class ServicesController extends Controller
{
    //

    
    public function index(){
        $services = Services::all();

        return view('services.index', compact('services'));

    }

    public function create(){
        
        return view('services.create');

    }

    public function sendData(Request $request){

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

        $service = new Services();
        $service->name =$request->input('name');
        $serviceName=$service->name;
        $service->description =$request->input('description');
        $service->price =$request->input('price');
        $service->save();
        $notification = 'The ' . $serviceName. ' service has been created successfully';
        return redirect('/servicesaut')->with(compact('notification'));
    }

 

    public function edit($id) {
        $service = Services::findOrFail($id);
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, Services $service){

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
        return redirect('/servicesaut')->with(compact('notification'));
    }

    public function destroy(Services $service){

        $deleteName = $service->name;
        $service->delete();
        $notification = 'The '.$deleteName. 'service has been successfully removed.';


        return redirect('/servicesaut')->with(compact('notification'));


    }
}
