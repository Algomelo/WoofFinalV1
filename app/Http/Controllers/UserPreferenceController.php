<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPreferenceController extends Controller
{
    public function updateShowManualPreference(Request $request)
    {
     
        $user = Auth::user();
        $showManual = $request->input('noMostrarManual'); // Obtener el valor del checkbox

        // Convertir el valor del checkbox a un booleano
        $user->show_manual = $showManual; // O actualiza este valor según la lógica que necesites
        $user->save();

    }
}

