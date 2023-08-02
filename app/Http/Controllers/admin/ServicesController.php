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
        $service->description =$request->input('description');
        $service->price =$request->input('price');
        $service->save();
        $notification = 'the service has been created successfully';
        return redirect('/services')->with(compact('notification'));
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

 
        $service->name =$request->input('name');
        $service->description =$request->input('description');
        $service->price =$request->input('price');
        $service->save();
        $notification = 'the service has been successfully modified';
        return redirect('/services')->with(compact('notification'));
    }

    public function destroy(Services $service){

        $deleteName = $service->name;
        $service->delete();
        $notification = 'The'.$deleteName. 'service has been successfully removed.';


        return redirect('/services')->with(compact('notification'));


    }
}
