<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrosMail;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/|confirmed',
            'address' => ['required', 'string', 'max:255'], // Agregar reglas de validación para el campo 'address'
            'phone' => ['required', 'int', 'min:6'],
            'petname'=>['required'],
        ], [
            'petname' => 'The name pet field is required',
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email has already been taken.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters long.',
            'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, and one digit.',
            'password.confirmed' => 'The password confirmation does not match.',
            'address.required' => 'The address field is required.',
            'phone.required' => 'The phone field is required.',
            'phone.int' => 'The phone must be an integer value.',
            'phone.min' => 'The phone must be at least 6 characters long.',
        ]);
    }
    

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // Capitalizar la primera letra del nombre de la mascota si está presente
        if (isset($data['petname'])) {
            $data['petname'] = ucfirst($data['petname']);
        }
        if (isset($data['address'])) {
            $data['address'] = ucfirst($data['address']);
        }

        $data['phone'] = ("0 " . $data['phone']) ;
       
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'address' => $data['address'],
            'phone' => $data['phone'],
            'petname' => $data['petname'],
        ]);
     
        $user->sendEmailVerificationNotification();
        try {
            // Define las direcciones de correo a las que deseas enviar
            $toEmails = ['fabianrodriguezbrochero98@gmail.com', 'juanpava1212@gmail.com'];

            // Envia el correo a ambas direcciones
            Mail::to($toEmails)
                ->send(new RegistrosMail($data));
            } catch (\Exception $e) {
            dd($e->getMessage()); // Agrega esta línea para ver el mensaje de error específico
            return response()->json(['error' => 'Error al enviar la solicitud. Por favor, inténtalo de nuevo más tarde.'], 500);
        }
    return $user;

    }
    
}
