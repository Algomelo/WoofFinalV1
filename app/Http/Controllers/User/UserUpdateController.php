<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;

class UserUpdateController extends Controller
{
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
        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('public/images');
            $user->photo = basename($imagePath);
            $user->save();
        }


        $notification = 'The user information has been successfully registered.';

        $notification = 'La informacion del usuario se ha registrado correctamente.';
        return redirect()->route('home', compact('user'));
    }


    /**
     * Remove the specified resource from storage.
     */




}


