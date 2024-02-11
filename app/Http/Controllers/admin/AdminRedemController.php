<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Package;  // Asegúrate de que estás importando la clase Package
use App\Models\Services;
use App\Models\User;
use App\Models\ServiceRequest;
use App\Models\Redemption;
use App\Models\Scheduled;
use App\Models\Pet;

class AdminRedemController extends Controller
{
    public function index(Request $request)
    {
        // Obtén la solicitud de servicio a redimir para el usuario específico
        // Obtén los servicios redimidos asociados a la solicitud
        $scheduled = Scheduled::with( 'user')->orderByDesc('created_at')->get();
    
        // Obtén los paquetes redimidos asociados a la solicitud
        return view('admin.AdminRedeemIndex', compact( 'scheduled'));
    }



    public function edit(Request $request, $scheduledId)
    {
        // Obtén el servicio redimido específico
        $scheduled = Scheduled::findOrFail($scheduledId);
        
        $user = $scheduled->user;
        $pets = $scheduled->pets;
        $service = $scheduled->service;
        $scheduledDates = $this->getFormattedScheduledDates($scheduled->date);   //  datos para mostrar el calendario 
        $allWalkers = User::where('role', 'walker')->get();
        
        // Puedes pasar esta información a la vista
        return view('admin.AdminRedeemEdit', compact('scheduled','pets','user','service' ,'scheduledDates','allWalkers'));
    }

    private function getFormattedScheduledDates($scheduledDates)
    {
        // Convierte las fechas almacenadas en la base de datos al formato adecuado para JavaScript
        $formattedDates = [];

        foreach (explode(',', $scheduledDates) as $date) {
            $formattedDates[] = Carbon::parse($date)->format('Y-m-d');
        }

        return $formattedDates;
    }
    
    public function update(Request $request, $scheduledId)
    {
        $scheduled = Scheduled::findOrFail($scheduledId);  
        $scheduled->update([
            'state' => "Approved",
            'date' => $request->input('date'),
            'shift' => $request->input('shift'),
            'comment' => $request->input('comment'),
            'address' => $request->input('address'),
            'walker_id' => $request->input('walkers'),
        ]);

        $notification="Dsgdsg";

        return redirect('/serviceRedems')->with(compact('notification'));

    }
}



