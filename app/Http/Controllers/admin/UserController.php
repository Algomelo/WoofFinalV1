<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\admin\PackageController;
use App\Http\Controllers\admin\ServicesController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Package;  // Asegúrate de que estás importando la clase Package
use App\Models\Services;


class UserController extends Controller
{
    public function index()
    {
        $users = User::users()->paginate(100);
        $services = Services::all();
        $packages = Package::all();
        return view('users.index', compact('users', 'packages'));

    }


    public function assignPackagesForm($userId)
    {
        // Obtener el usuario
        $user = User::findOrFail($userId);

        // Obtener todos los paquetes disponibles
        $allPackages = Package::all();

        // Obtener los paquetes asignados al usuario
        $userPackages = $user->packages;

        return view('users.userservices', compact('user', 'allPackages', 'userPackages'));
    }
    public function assignPackages(Request $request, $userId)
    {
        // Obtener el usuario
        $user = User::findOrFail($userId);
    
        // Obtener los paquetes seleccionados
        $selectedPackages = $request->input('selected_packages', []);
    
        // Verificar si hay paquetes seleccionados
        if (empty($selectedPackages)) {
            return redirect()->back()->with('error', 'Debes seleccionar al menos un paquete.');
        }
    
        // Asignar los paquetes al usuario
        $user->packages()->sync($selectedPackages);
    
        // Redirigir con un mensaje de éxito
        return redirect()->route('users.assignPackagesForm', $userId)->with('success', 'Paquetes asignados exitosamente.');
    }
    
    public function assignServicesForm($userId)
    {
        // Obtener el usuario
        $user = User::findOrFail($userId);

        // Obtener todos los paquetes disponibles
        $allServices = Services::all();

        // Obtener los paquetes asignados al usuario
        $userServices = $user->services;

        return view('users.userservices', compact('user', 'allServices', 'userServices'));
    }
    public function assignServices(Request $request, $userId)
    {
        // Obtener el usuario
        $user = User::findOrFail($userId);
    
        // Obtener los paquetes seleccionados
        $selectedServices = $request->input('selected_Services', []);
    
        // Verificar si hay paquetes seleccionados
        if (empty($selectedServices)) {
            return redirect()->back()->with('error', 'Debes seleccionar al menos un paquete.');
        }
    
        // Asignar los paquetes al usuario
        $user->services()->sync($selectedServices);
    
        // Redirigir con un mensaje de éxito
        return redirect()->route('users.assignServiceForm', $userId)->with('success', 'Paquetes asignados exitosamente.');
    }

        public function showPackagesById($userId, $packageId)
    {
        // Obtener el usuario
        $user = User::findOrFail($userId);

        // Obtener el paquete específico asignado al usuario
        $package = $user->packages()->find($packageId);

        // Verificar si el paquete existe para el usuario
        if (!$package) {
            return redirect()->route('users.show', $userId)->with('error', 'El paquete no está asignado a este usuario.');
        }

        // Obtener todos los paquetes asignados al usuario
        $userPackages = $user->packages;

        // Puedes pasar la información del usuario, el paquete específico y todos los paquetes al usuario a la vista
        return view('users.userservices', ['user' => $user, 'package' => $package, 'userPackages' => $userPackages]);

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


