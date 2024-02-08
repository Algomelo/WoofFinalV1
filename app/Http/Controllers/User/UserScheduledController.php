<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Models\Scheduled;
use Illuminate\Support\Facades\Auth;


class UserScheduledController extends Controller
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
        return view('users.UserScheduledIndex', compact( 'scheduled'));
    }
    public function edit( $scheduledsid)
    {

    }

}



