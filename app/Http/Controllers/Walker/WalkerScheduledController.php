<?php

namespace App\Http\Controllers\Walker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Package;  // Asegúrate de que estás importando la clase Package
use App\Models\Services;
use App\Models\User;
use App\Models\ServiceRequest;
use App\Models\Scheduled;
use App\Models\Pet;
use Illuminate\Support\Facades\Auth;


class WalkerScheduledController extends Controller
{
    public function index(Request $request )
    {
        // Obtén la solicitud de servicio a redimir para el usuario específico
        $userId = Auth::id();
        $scheduled = Scheduled::with('user')
            ->where('user_id', $userId)
            ->orderByDesc('created_at')
            ->get();    
        // Obtén los paquetes redimidos asociados a la solicitud
        return view('walkers.WalkerScheduledIndex', compact( 'scheduled'));
    }

}



