<?php

// En el controlador ScheduledController.php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;

use App\Models\ServiceRequest;

use App\Models\Scheduled;
use Illuminate\Http\Request;

class ScheduledController extends Controller
{
    public function index($user_id)
    {
        $passedservices = ServiceRequest::where('state', 'passed')->with('Services')->get();
        // En tu controlador
        return view('users.UserScheduledIndex', ['passedservices' => $passedservices]);

    }

    public function create()
    {
        // Lógica para mostrar el formulario de creación
    }

    public function store(Request $request)
    {
        // Lógica para almacenar un nuevo Scheduled en la base de datos
    }

    public function show(Scheduled $scheduled)
    {
        // Lógica para mostrar los detalles de un Scheduled específico
    }

    public function edit(Scheduled $scheduled)
    {
        // Lógica para mostrar el formulario de edición
    }

    public function update(Request $request, Scheduled $scheduled)
    {
        // Lógica para actualizar un Scheduled en la base de datos
    }

    public function destroy(Scheduled $scheduled)
    {
        // Lógica para eliminar un Scheduled de la base de datos
    }
}
