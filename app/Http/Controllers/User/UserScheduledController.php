<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Pet;
use Illuminate\Support\Facades\Validator;
use App\Models\Scheduled;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;



class UserScheduledController extends Controller
{
    public function index(Request $request)
    {
        // Obtener el usuario autenticado
        $user = $request->user();
    
        // Obtener los eventos del usuario autenticado
        $events = $user->events()->get();
    
        $formattedEvents = [];
    
        foreach ($events as $event) {
            $address = $event->address;
            $shift = $event->shift;
            $phone = $event->phone;
            $description = $event->description;

                                                                                                
            $textFinal = "Het there," . $user->name . ".\n"  ."Great news - your furry friend's" . $event->event ." service is all set! 🐾". ".\n" .
             "🐶 Walker: Juan Pablo Vanegas" . ".\n" .  "🏡" . $address . ".\n" . "📞 Phone: ". $phone . ".\n" 
            ."🕒 Shift: ". $shift  ;
            
            
            $formattedEvents[] = [
                'title'=> $event->event, // a property!
                'start' => $event->start_date, // a property!
                'end' => $event->end_date, // a property! ** see important note below about 'end' **
                'description' => $textFinal, // Agregar descripción u otra información adicional
            ];
        }
    
        return view('users.UserScheduledIndex', compact('formattedEvents'));
    }
    

    public function edit(string $id)
    {


       $userId = Auth::id();
       $user = User::findOrFail($userId);
       $scheduled = Scheduled::findOrFail($id);
       $scheduledDates = $this->getFormattedScheduledDates($scheduled->date);   //  datos para mostrar el calendario 
       $scheduled->shift;

       return view('users.UserScheduledEdit', compact('scheduledDates','scheduled', 'user'));
    }

    public function update(Request $request, string $id)
    {

    
        $scheduled = Scheduled::findOrFail($id);
        $scheduled->date = $request->input('date');
        $scheduled->shift = $request->input('shift');
        $scheduled->comment = $request->input('comment');
        $scheduled->address = $request->input('address');


        $rules = [
            'date' => [
                'required',
                function ($attribute, $value, $fail) use ($scheduled) {
                    // Verificar si la cantidad de días seleccionados supera la cantidad total
                    $quantity = $scheduled->quantity;
                    $scheduledPets = $scheduled->namepets;
                    $petArray = explode(',', $scheduledPets);
                    $petCount = count($petArray);
                    $selectedDatesCount = count(explode(',', $value));
                    $count = $selectedDatesCount * $petCount;
                    if ($count > $quantity) {
                        $fail("Please keep in mind that the selected quantities cannot surpass the total available {$quantity} Also, note that each associated pet corresponds to a discount rate for every chosen date.");
                    }
                }
            ]
        ];

        $customMessages = [
            'date.required' => 'Please select at least one date.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        // Verificar si las reglas de validación fallan
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $scheduled->save();

        return redirect()->route('userScheduled.index');
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
}



