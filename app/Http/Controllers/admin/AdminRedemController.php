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
use App\Models\Event;


class AdminRedemController extends Controller
{
    public function index(Request $request)
    {
        $all_events = Event::all();
        $events = [];
        foreach ($all_events as $event){
            $shift = $event->user;
            $address = $event->address;
            $shift = $event->shift;
            $user = $event->user->name;
            $phone = $event->phone;
            $description= $event->description;

            $textFinal = "The user " . $user  ." has requested the service " . $event->event . ".\n" . "Address: " .$address . 
            ".\n" . "Phone: " . $phone .".\n" . "Shift: ".$shift .".\n" . "Comment: ". $description;
            
            
            $events[] = [
                'title'=> $event->event, // a property!
                'start' => $event->start_date, // a property!
                'end' => $event->end_date, // a property! ** see important note below about 'end' **
                'description' => $textFinal, // Agregar descripción u otra información adicional
            ];
        }
        $scheduled = Scheduled::with( 'user')->orderByDesc('created_at')->get();
        // Obtén los paquetes redimidos asociados a la solicitud
        return view('admin.AdminRedeemIndex', compact( 'scheduled', 'events'));
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



