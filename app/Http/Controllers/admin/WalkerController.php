<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
class WalkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $walkers = User::walkers()->paginate(10);
        return view ('walkers.index', compact('walkers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('walkers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'cedula' => 'required|min:6',
            'address' => 'required|min:6',
            'phone' => 'required',
        ];

        $messages = [

            'name.required' => 'El nombre del Paseador es obligatorio',
            'name.min' => 'El nombre del paseador debe tener mas de tres caracteres',
            'email.required'  => 'Debe ingresar un correo electronico valido',
            'email.unique'    => 'Este email ya esta registrado en el sistema',
            'cedula.required'   => 'La cedula del paseador es obligatoria',
            'cedula.numeric'     =>'solo se permiten numeros para la cedula',
            'cedula.digits_between'      => 'la longitud minima de la cedula son de 6 digitos',
            'address.required'       => 'La direccion del paseador es requerida',
            'address.min'        => 'La dirección debe contener al menos 6 digitos',
            'phone.required'         => 'El numero telefonico es obligatorio',

        ];

        $this->validate($request,$rules,$messages);

        User::create(
            $request->only('name','email','cedula','address','phone')
            +[
                'role' => 'walker',
                'password' => bcrypt($request->input('password'))
            ]
        );
        $notification = 'El paseador se ha registrado correctamente.';
        return redirect('/walkers')->with(compact('notification'));

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
       $walker = User::walkers()->findOrFail($id);
       return view('walkers.edit', compact('walker'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email', 
            'cedula' => 'required|min:6',
            'address' => 'required|min:6',
            'phone' => 'required',
        ];

        $messages = [

            'name.required' => 'El nombre del Paseador es obligatorio',
            'name.min' => 'El nombre del paseador debe tener mas de tres caracteres',
            'email.required'  => 'Debe ingresar un correo electronico valido',
            'email.unique'    => 'Este email ya esta registrado en el sistema',
            'cedula.required'   => 'La cedula del paseador es obligatoria',
            'cedula.numeric'     =>'solo se permiten numeros para la cedula',
            'cedula.digits_between'      => 'la longitud minima de la cedula son de 6 digitos',
            'address.required'       => 'La direccion del paseador es requerida',
            'address.min'        => 'La dirección debe contener al menos 6 digitos',
            'phone.required'         => 'El numero telefonico es obligatorio',

        ];

        $this->validate($request,$rules,$messages);
        $user = User::walkers()->findOrFail($id);

        $data = $request->only('name','email','cedula','address','phone');
        $password =$request->input('password');

        if($password)
        $data['password'] = bcrypt($password);
        $user->fill($data)->save();



        $notification = 'La informacion del paseador se ha registrado correctamente.';
        return redirect('/walkers')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::walkers()->findOrFail($id);
        $walkerName = $user->name;
        $user->delete();

        $notification = 'el paseador'.$walkerName. 'se elimino correctamente';
        
        return redirect('/walkers')->with(compact('notification'));

    }
}
