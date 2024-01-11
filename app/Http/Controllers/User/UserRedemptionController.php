<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Package;  // Asegúrate de que estás importando la clase Package
use App\Models\Services;
use App\Models\User;
use App\Models\ServiceRequest;
use App\Models\RedeemedService;

class UserRedemptionController extends Controller
{
    public function index(Request $request, $userId)
    {
        // Obtén la solicitud de servicio a redimir para el usuario específico

            // Obtén los servicios redimidos asociados a la solicitud
            $redeemedServices = RedeemedService::where('user_id', $userId)->get();
            // Obtén los paquetes redimidos asociados a la solicitud


            return view('users.UserScheduledIndex', compact( 'redeemedServices'));
   
    }
}



