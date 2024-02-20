<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;


class UserController extends Controller
{
    public function index()
    {
        $users = User::users()->paginate(100);

        return view('users.index', compact('users'));

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
            'address' => 'required|min:6',
            'phone' => 'required',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/|confirmed',

        ];

        $messages = [
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters long.',
            'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, and one digit.',
            'password.confirmed' => 'The password confirmation does not match.',
            'name.required' => 'User name is required',
            'name.min' => 'User name must be more than three characters',
            'email.required' => 'You must enter a valid email address',
            'email.unique' => 'This email is already registered in the system',
            'cedula.required' => 'ID number is required',
            'cedula.numeric' => 'Only numbers are allowed for the ID number',
            'cedula.digits_between' => 'ID number must be between 6 and 10 digits long',
            'address.required' => 'Walker address is required',
            'address.min' => 'The address must contain at least 6 digits',
            'phone.required' => 'Phone number is required',
        ];

        $this->validate($request,$rules,$messages);

        User::create(
            $request->only('name','email','cedula','address','phone')
            +[
                'role' => 'user',
                'password' => bcrypt($request->input('password'))
            ]
        );
        $notification = 'The user has been registered successfully.';
        
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
            'address' => 'required|min:6',
            'phone' => 'required',
            'password' => 'nullable|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/|confirmed',

        ];

        $messages = [
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters long.',
            'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, and one digit.',
            'password.confirmed' => 'The password confirmation does not match.',
            'name.required' => 'User name is required',
            'name.min' => 'User name must be more than three characters',
            'email.required' => 'You must enter a valid email address',
            'email.unique' => 'This email is already registered in the system',
            'address.required' => 'Walker address is required',
            'address.min' => 'The address must contain at least 6 digits',
            'phone.required' => 'Phone number is required',

        ];

        $this->validate($request,$rules,$messages);
        $user = User::users()->findOrFail($id);

        $data = $request->only('name','email','cedula','address','phone');
        $password =$request->input('password');

        if($password)
        $data['password'] = bcrypt($password);
        $user->fill($data)->save();


        $notification = 'The user information has been successfully registered.';
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

        $notification = 'User '.$userName. 'was successfully deleted';
        
        return redirect('/users')->with(compact('notification'));

    }



    public function deleteSelectedUsers(Request $request)
{
    $ids = $request->input('ids');

    // Realiza la lógica para eliminar los usuarios con los IDs proporcionados
    User::whereIn('id', $ids)->delete();

    return response()->json(['message' => 'Successfully deleted users.']);
}

}


