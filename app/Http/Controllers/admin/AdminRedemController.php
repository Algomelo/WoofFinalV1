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
        $scheduled = Redemption::with( 'user', 'pets', 'service')->orderByDesc('created_at')->get();
    
        // Obtén los paquetes redimidos asociados a la solicitud
        return view('admin.AdminRedeemIndex', compact( 'scheduled'));
    }



    public function edit(Request $request, $scheduledId)
    {
        // Obtén el servicio redimido específico
        $scheduled = Redemption::findOrFail($scheduledId);
        
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
    
    public function store(Request $request, $scheduledId)
    {

        $scheduled = Redemption::findOrFail($scheduledId);  

        $scheduled->state = "Send To Walker";

        $scheduled->save();

        $dateScheduled = $request->input('date');
        $shiftScheduled = $request->input('shift');
        $commentScheduled = $request->input('comment');
        $addressScheduled = $request->input('address');

        $serviceScheduled = $scheduled->service->name;
        $petScheduled = $scheduled->pets->pluck('name')->toArray();

        $walkerId = $request->input('walkers');

        $scheduled->approveScheduled($walkerId, $serviceScheduled, $petScheduled, $dateScheduled, $shiftScheduled, $commentScheduled ,$addressScheduled);

        
        return redirect()->route('user.RedemptionController.index', ['userId' => $userId]);

    }
}



