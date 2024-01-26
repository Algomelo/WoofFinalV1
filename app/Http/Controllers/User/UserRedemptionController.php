<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Package;  // Asegúrate de que estás importando la clase Package
use App\Models\Services;
use App\Models\User;
use App\Models\ServiceRequest;
use App\Models\RedeemedService;
use App\Models\Pet;
use App\Models\Redemption;


class UserRedemptionController extends Controller
{
    public function index(Request $request, $userId)
    {
        // Obtén la solicitud de servicio a redimir para el usuario específico
            // Obtén los servicios redimidos asociados a la solicitud
            $redeemedServices = RedeemedService::where('user_id', $userId)->get();
            // Obtén los paquetes redimidos asociados a la solicitud
            return view('users.UserRedeemIndex', compact( 'redeemedServices'));
   
    }

    public function create(Request $request, $userId, $redeemedServiceId)
    {
        // Obtén el servicio redimido específico
        $redeemedServices = RedeemedService::findOrFail($redeemedServiceId);
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
    
    public function store(Request $request, $userId, $redeemedServiceId)
    {
        $request->validate([
            // Validaciones...
        ]);

        $redeemedServices = RedeemedService::findOrFail($redeemedServiceId);

        $idService = $redeemedServices->service_id;
        // Resto de la lógica para redimir el servicio y asociar mascotas
        $redemption = new Redemption();
        $user_id = $request->input('user_id');
        $redemption->user_id = $user_id;
        $redemption->service_id = $idService;
        $redemption->quantity = $request->input('quantity');
        $redemption->state = 'Send To Admin';
        $redemption->date = $request->input('date');
        $redemption->address = $request->input('address');
        $redemption->comment = $request->input('comment');
        $redemption->shift = $request->input('shift');
        $redemption->save();
    

        if ($request->has('pets')) {
            $redemption->pets()->attach($request->input('pets'), ['quantity' => $request->input('quantity')]);
            $quantitypets = count($request->input('pets'));
            // Asegúrate de que la cantidad a reducir no sea mayor que la cantidad actual
            $cantidadAReducir = min($quantitypets, $redeemedServices->quantity);    
            // Si hay más de una unidad, reducimos la cantidad según la cantidad de mascotas seleccionadas
            if ($cantidadAReducir > 0) {
                $redeemedServices->decrement('quantity', $cantidadAReducir);    
                // Si la cantidad llega a cero, eliminamos el registro
                if ($redeemedServices->quantity == 0) {
                    $redeemedServices->delete();
                }
            }
        }    
        
        return redirect()->route('user.RedemptionController.index', ['userId' => $userId]);

    }
}



