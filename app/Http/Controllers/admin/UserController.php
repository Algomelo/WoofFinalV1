<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\admin\PackageController;
use App\Http\Controllers\admin\ServicesController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Package;  // Asegúrate de que estás importando la clase Package
use App\Models\Services;
use App\Models\ServiceRequest;


class UserController extends Controller
{
    public function index()
    {
        $users = User::users()->paginate(100);
        $services = Services::all();
        $packages = Package::all();
        return view('users.index', compact('users', 'packages'));

    }



    public function assignRequestForm($userId)
    {
        // Obtener el usuario
        $user = User::findOrFail($userId);

        // Obtener todos los paquetes disponibles
        $allPackages = Package::all();
        $allServices = Services::all();

        // Obtener los paquetes asignados al usuario
        $userPackages = $user->packages;
        $userServices= $user->services;


        return view('users.userservices', compact('user', 'allPackages', 'userPackages', 'allServices', 'userServices'));
    }
   
    public function assignServices(Request $request, $userId)
    {
        // Obtener el usuario
        $user = User::findOrFail($userId);
    
        // Obtener los paquetes seleccionados

        $selectedServices = $request->input('services');
        $selectedPackages = $request->input('packages');


        // Verificar si hay paquetes seleccionados
        // Verificar si hay paquetes seleccionados
        if (empty($selectedPackages)) {
            return redirect()->back()->with('error', 'Debes seleccionar al menos un servicio.');
        }

        // Agrega esta línea para verificar los paquetes seleccionados
        //  dd($selectedPackages);

        foreach ($selectedPackages as $packageId) {
            // Verificar si el servicio tiene una cantidad válida
            $quantity = isset($quantities[$packageId]) ? $quantities[$packageId] : 0;
    
            // Agregar el servicio y cantidad al array de datos
            $serviceData[$packageId] = ['quantity' => $quantity];
        }

        // Asignar los paquetes al usuario
        $user->packages()->sync($selectedPackages);

        // Redirigir con un mensaje de éxito
        return redirect()->route('users.assignRequestForm', $userId)->with('success', 'Paquetes asignados exitosamente.');

    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'cedula' => 'required|digits_between:6,10',
            'address' => 'required|min:6',
            'phone' => 'required',
        ];

        $messages = [

            'name.required' => 'El nombre del usuario es obligatorio',
            'name.min' => 'El nombre del usuario debe tener mas de tres caracteres',
            'email.required'  => 'Debe ingresar un correo electronico valido',
            'email.unique'    => 'Este email ya esta registrado en el sistema',
            'cedula.required'   => 'La cedula  es obligatoria',
            'cedula.numeric'     =>'solo se permiten numeros para la cedula',
            'cedula.digits_between'      => 'la longitud  de la cedula debe tener entre 6 y 10 digitos',
            'address.required'       => 'La direccion del paseador es requerida',
            'address.min'        => 'La dirección debe contener al menos 6 digitos',
            'phone.required'         => 'El numero telefonico es obligatorio',

        ];

        $this->validate($request,$rules,$messages);

        User::create(
            $request->only('name','email','cedula','address','phone')
            +[
                'role' => 'user',
                'password' => bcrypt($request->input('password'))
            ]
        );
        $notification = 'El usuario se ha registrado correctamente.';
        return redirect('/users')->with(compact('notification'));
    }


    public function edit(string $id)
    {
        $user = User::users()->findOrFail($id);
        return view('users.edit', compact('user'));
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



        $notification = 'La informacion del usuario se ha registrado correctamente.';
        return redirect('/users')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::users()->findOrFail($id);
        $userName = $user->name;
        $user->delete();

        $notification = 'el paseador'.$userName. 'se elimino correctamente';
        
        return redirect('/users')->with(compact('notification'));

    }



    public function deleteSelectedUsers(Request $request)
{
    $ids = $request->input('ids');

    // Realiza la lógica para eliminar los usuarios con los IDs proporcionados
    User::whereIn('id', $ids)->delete();

    return response()->json(['message' => 'Usuarios eliminados correctamente.']);
}

}


