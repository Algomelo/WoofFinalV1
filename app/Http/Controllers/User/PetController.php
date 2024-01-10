<?php

// En PetController.php


namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;
use App\Models\User;


class PetController extends Controller
{
    public function index($userId)
    {
    
        // Filtra los pets por el user_id del usuario autenticado
        $pets = Pet::where('user_id', $userId)->get();

        return view('users.UserPetsIndex', compact('pets', 'userId'));       
    }

    public function create($userId)
    
    {
        $user = User::findOrFail($userId);

        return view('users.UserPetsCreate',  compact( 'userId')); 
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'age' => 'required|numeric',
            'breed' => 'nullable',
            'comment' => 'nullable',
            'user_id' => 'sometimes',
        ]);
        $pet = Pet::create($validatedData);


        return redirect()->route('user.pets.index', ['userId' => $validatedData['user_id']])->with('success', 'Pet created successfully');

    }
        public function edit($userId, $petId)
        {
      
            $pet = Pet::findOrFail($petId);
        
            return view('users.UserPetsEdit', compact('pet', 'userId'));
        }

    public function update(Request $request, $userId, $petId)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'age' => 'required|numeric',
            'breed' => 'nullable',
            'comment' => 'nullable',
            'user_id' => 'sometimes',
        ]);
    
        $pet = Pet::findOrFail($petId);
        $pet->update($validatedData);
    
        return redirect()->route('user.pets.index', ['userId' => $userId])->with('success', 'Pet updated successfully');
    }



        public function destroy($userId, $petId)
    {
        $pet = Pet::findOrFail($petId);
        $pet->delete();

        return redirect()->route('user.pets.index', ['userId' => $userId])->with('success', 'Pet deleted successfully');
    }


    

    // Otros métodos como show, edit, update y destroy...
}
