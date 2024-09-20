<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\LandingMail;
use App\Rules\Recaptcha;


class LandingController extends Controller
{



    public function confirmLanding(Request $request)
    {
        // Aquí puedes validar los datos del formulario
        // Procesa y almacena los datos de la solicitud
        $request->validate([
            'g-recaptcha-response' => ['required', new Recaptcha]

        ]);
        // Enviar el correo a dos direcciones de correo electrónico
        $service = $request->input('service');
        $data = $request->all();
        
        try {
            // Define las direcciones de correo a las que deseas enviar
            $toEmails = ['info@ohmywoof.com.au', 'juanpava1212@gmail.com'];
            
            // Envia el correo a ambas direcciones
            Mail::to($toEmails)
                ->send(new LandingMail($service, $data));
    
                return response()->json(['status' => 'success']);
            } catch (\Exception $e) {
            dd($e->getMessage()); // Agrega esta línea para ver el mensaje de error específico
            return response()->json(['error' => 'Error al enviar la solicitud. Por favor, inténtalo de nuevo más tarde.'], 500);
        }
    }


}