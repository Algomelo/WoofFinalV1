<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Package;  // Asegúrate de que estás importando la clase Package
use App\Models\Services;
use App\Models\User;
use App\Models\ServiceRequest;
use App\Models\Redemption;
use App\Models\Scheduled;
use App\Models\Pet;


class AdminScheduledController extends Controller
{
    public function index(Request $request)
    {
        // Obtén la solicitud de servicio a redimir para el usuario específico
        // Obtén los servicios redimidos asociados a la solicitud
        $scheduled = Redemption::with( 'user', 'pets', 'service')->orderByDesc('created_at')->get();

    
        // Obtén los paquetes redimidos asociados a la solicitud
        return view('admin.AdminRedeemIndex', compact( 'scheduled'));
    }



    public function create(Request $request, $userId, $redeemedServiceId)
    {
        // Obtén el servicio redimido específico
        $redeemedServices = RedeemedService::findOrFail($redeemedServiceId);
    
        // Obtén información adicional sobre el servicio (si es necesario)
        $serviceName = $redeemedServices->service->name;
        $serviceCreatedAt = $redeemedServices->service->created_at;
        $quantity = $redeemedServices->quantity;
        $state = $redeemedServices->state;
        $pets = Pet::where('user_id', $userId)->get();
        

    
        // Puedes pasar esta información a la vista
        return view('users.UserRedeemCreate', compact('redeemedServices', 'userId', 'serviceName', 'serviceCreatedAt', 'quantity', 'state' , 'pets'));
    }
    
    public function store(Request $request, $userId, $redeemedServiceId)
    {
        $request->validate([
            // Validaciones...
        ]);
        $redeemedServices = RedeemedService::findOrFail($redeemedServiceId);

        // Resto de la lógica para redimir el servicio y asociar mascotas
        $redemption = new Redemption();
        $user_id = $request->input('user_id');
        $redemption->user_id = $user_id;
        $redemption->service_id = $redeemedServiceId;
        $redemption->quantity = $request->input('quantity');
        $redemption->state = 'Send';
        $redemption->date = $request->input('date');
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



