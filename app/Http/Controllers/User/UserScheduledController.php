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



