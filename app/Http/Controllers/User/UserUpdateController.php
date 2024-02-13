<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;


class UserUpdateController extends Controller
{
  
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

            'name.required' => 'El nombre del usuario es obligatorio',
            'name.min' => 'El nombre del usuario debe tener mas de tres caracteres',
            'email.required'  => 'Debe ingresar un correo electronico valido',
            'email.unique'    => 'Este email ya esta registrado en el sistema',
            'cedula.required'   => 'La cedula del paseador es obligatoria',
            'cedula.numeric'     =>'solo se permiten numeros para la cedula',
            'cedula.digits_between'      => 'la longitud minima de la cedula son de 6 digitos',
            'address.required'       => 'La direccion del usuario es requerida',
            'address.min'        => 'La dirección debe contener al menos 6 digitos',
            'phone.required'         => 'El numero telefonico es obligatorio',

        ];
        
        $this->validate($request,$rules,$messages);
        $user = User::users()->findOrFail($id);

        $data = $request->only('name','email','cedula','address','phone');
        $password =$request->input('password');

        if($password)
        $data['password'] = bcrypt($password);
        $user->fill($data)->save();
        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('public/images');
            $user->photo = basename($imagePath);
            $user->save();
        }



        $notification = 'La informacion del usuario se ha registrado correctamente.';
        return redirect()->route('home', compact('user'));

    }

    /**
     * Remove the specified resource from storage.
     */




}


