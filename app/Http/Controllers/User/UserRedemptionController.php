<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\RedeemedService;
use App\Models\Pet;
use App\Models\Redemption;
use App\Models\Scheduled;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;


class UserRedemptionController extends Controller
{
    public function index()
    {
        // Obtén la solicitud de servicio a redimir para el usuario específico
            // Obtén los servicios redimidos asociados a la solicitud
            $userId = Auth::id();
            $redeemedServices = RedeemedService::where('user_id', $userId)->get();
            // Obtén los paquetes redimidos asociados a la solicitud
            return view('users.UserRedeemIndex', compact( 'redeemedServices'));

   
    }

    public function create(Request $request, $redeemedServiceId)
    {
        // Obtén el servicio redimido específico
        $redeemedServices = RedeemedService::findOrFail($redeemedServiceId);
        $userId = Auth::id();

        $user = User::findOrFail($userId);
        // Obtén información adicional sobre el servicio (si es necesario)
        $serviceName = $redeemedServices->service->name;
        $serviceCreatedAt = $redeemedServices->service->created_at;
        $quantity = $redeemedServices->quantity;
        $state = $redeemedServices->state;
        $pets = Pet::where('user_id', $userId)->get();
        

    
        // Puedes pasar esta información a la vista
        return view('users.UserRedeemCreate', compact('redeemedServices', 'user', 'serviceName', 'serviceCreatedAt', 'quantity', 'state' , 'pets'));
    }
    
    public function store(Request $request,  $redeemedServiceId)
    {
        $userId = Auth::id();



        $redeemedServices = RedeemedService::findOrFail($redeemedServiceId);

        $idService = $redeemedServices->service_id;
        // Resto de la lógica para redimir el servicio y asociar mascotas
        $redemption = new Redemption();
        $user_id = $request->input('user_id');
        $redemption->user_id = $user_id;
        $redemption->service_id = $idService;
        $redemption->quantity = $request->input('quantity');
        $redemption->state = 'Send To Admin';

        $redemptiondate = $request->input('date');
        $datesArray = explode(", ",  $redemptiondate);
        $countDate = count($datesArray);




        $redemption->save();
        
        if ($request->has('pets')) {
            $redemption->pets()->attach($request->input('pets'), ['quantity' => $request->input('quantity')]);
            $quantitypets = count($request->input('pets'));
            $cantidadAReducir = $quantitypets * $countDate;

            // Asegúrate de que la cantidad a reducir no sea mayor que la cantidad actual
            $cantidadAReducir = min($cantidadAReducir , $redeemedServices->quantity);    
            // Si hay más de una unidad, reducimos la cantidad según la cantidad de mascotas seleccionadas
            if ($cantidadAReducir > 0) {
                $redeemedServices->decrement('quantity', $cantidadAReducir);    
                // Si la cantidad llega a cero, eliminamos el registro
                if ($redeemedServices->quantity == 0) {
                    $redeemedServices->delete();
                }
            }
        }    

        $redemption = Redemption::findOrFail($redemption->id);  

        $petScheduled = $redemption->pets->pluck('name')->toArray();
        $petScheduled = implode(',', $petScheduled);
        $serviceNameScheduled = $redemption->service->name;
        $userIdScheduled = $request->input('user_id');
        $dateScheduled =  $request->input('date');
        $shiftScheduled = $request->input('shift');
        $commentScheduled = $request->input('comment');
        $addressScheduled = $request->input('address');
        $quantityScheduled = $cantidadAReducir;

        $uniqueNumber = mt_rand(100000, 999999);                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    

        
        Scheduled::create([
            'nameservice' => $serviceNameScheduled,
            'user_id' => $userIdScheduled,
            'walker_id' => null,
            'state' => "Send",
            'date' =>  $dateScheduled,
            'shift' => $shiftScheduled  , 
            'comment' => $commentScheduled,
            'address' => $addressScheduled,
            'namepets' =>  $petScheduled ,
            'quantity' => $quantityScheduled,
            'unique_number' => $uniqueNumber
        ]);
        return redirect()->route('userRedemption.index');
    }
}



