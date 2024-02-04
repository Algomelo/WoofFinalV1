<?php

// En PetController.php


namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class PetController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        // Filtra los pets por el user_id del usuario autenticado
        $pets = Pet::where('user_id', $userId)->get();

        return view('users.UserPetsIndex', compact('pets', 'userId'));       
    }

    public function create()
    
    {
        $userId = Auth::id();

        $user = User::findOrFail($userId);

        return view('users.UserPetsCreate',  compact( 'userId')); 
    }

    public function store(Request $request)
    {
        $userId = Auth::id();

        $validatedData = $request->validate([
            'name' => 'required',
            'age' => 'required|numeric',
            'breed' => 'nullable',
            'comment' => 'nullable',
        ]);
        $validatedData['user_id'] = $userId;

        $pet = Pet::create($validatedData);


        return $this->index();

    }
        public function edit( $petId)
        {
            $userId = Auth::id();

            $pet = Pet::findOrFail($petId);
        
            return view('users.UserPetsEdit', compact('pet', 'userId'));
        }

    public function update(Request $request, $petId)
    {
        $userId = Auth::id();
        $validatedData = $request->validate([
            'name' => 'required',
            'age' => 'required|numeric',
            'breed' => 'nullable',
            'comment' => 'nullable',
            'user_id' => 'sometimes',
        ]);
    
        $pet = Pet::findOrFail($petId);
        $pet->update($validatedData);
        return $this->index();

    }



        public function destroy($petId)
    {
        $userId = Auth::id();

        $pet = Pet::findOrFail($petId);
        $pet->delete();

        return $this->index();
    }


    

    // Otros métodos como show, edit, update y destroy...
}
